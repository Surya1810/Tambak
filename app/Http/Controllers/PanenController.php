<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Kolam;
use App\Models\Panen;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tambak = User::find(Auth::user()->id)->tambak->first()->id;
        $kolam = Kolam::where('tambak_id', $tambak)->pluck('id')->toArray();

        $panen = Panen::whereIn('kolam_id', $kolam)->get();
        return view('panen.index', compact('panen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);
        $satuans = Satuan::all();

        return view('panen.create', compact('kolams', 'satuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kolam' => 'bail|required',
            'satuan' => 'bail|required',
            'grade' => 'bail|required',
            'jenis_panen' => 'bail|required',
            'size' => 'bail|required',
            'volume' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Panen();
        $project->owner_id = Auth::user()->created_by;
        $project->user_id = Auth::user()->id;
        $project->kolam_id = $request->kolam;
        $project->satuan_id = $request->satuan;
        $project->grade = $request->grade;
        $project->size = $request->size;
        $project->jenis_panen = $request->jenis_panen;

        //Menghitung Harga dan Total
        $dataHargaUdang = Harga::where('tambak_id', Auth::user()->created_by)->pluck('harga', 'size');
        $ukuranYangDicari = $request->size;

        if ($dataHargaUdang->has($ukuranYangDicari)) {
            // Jika ukuran yang dicari tepat ada dalam data, gunakan harga yang sudah ada
            $hargaUdang = $dataHargaUdang[$ukuranYangDicari];
        } else {
            // Jika tidak, lakukan interpolasi linear
            $ukuranTerdekatSebelumnya = $dataHargaUdang->filter(function ($harga, $ukuran) use ($ukuranYangDicari) {
                return $ukuran < $ukuranYangDicari;
            })->keys()->max();

            $ukuranTerdekatSelanjutnya = $dataHargaUdang->filter(function ($harga, $ukuran) use ($ukuranYangDicari) {
                return $ukuran > $ukuranYangDicari;
            })->keys()->min();

            // Tambahkan kondisi if else untuk menangani null
            if ($ukuranTerdekatSebelumnya !== null && $ukuranTerdekatSelanjutnya !== null) {
                // Interpolasi linear
                $hargaTerdekatSebelumnya = $dataHargaUdang[$ukuranTerdekatSebelumnya];
                $hargaTerdekatSelanjutnya = $dataHargaUdang[$ukuranTerdekatSelanjutnya];

                // Hitung harga dengan interpolasi linear
                $hargaUdang = (($ukuranYangDicari - $ukuranTerdekatSebelumnya) * ($hargaTerdekatSelanjutnya - $hargaTerdekatSebelumnya) / ($ukuranTerdekatSelanjutnya - $ukuranTerdekatSebelumnya)) + $hargaTerdekatSebelumnya;
            } else {
                $old = session()->getOldInput();
                return back()->with(['pesan' => 'Data ukuran dan harga tidak sesuai', 'level-alert' => 'alert-danger'])->withInput();
            }
        }

        $project->harga = $hargaUdang;
        $project->volume = $request->volume;
        $project->total = $request->volume * $hargaUdang;
        $project->save();

        return redirect()->route('panen.index')->with(['pesan' => 'Data panen berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Panen $panen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panen $panen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Panen $panen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Panen::find($id);
        $data->delete();

        return redirect()->route('panen.index')->with(['pesan' => 'Data panen berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
