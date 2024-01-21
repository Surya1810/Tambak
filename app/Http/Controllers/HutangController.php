<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Hutang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akuns = Akun::where('owner_id', Auth::user()->created_by)->get();
        $suppliers = Supplier::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', '=', true)->get();
        $hutang = Hutang::where('owner_id', Auth::user()->created_by)->get();

        return view('hutang.index', compact('hutang', 'akuns', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'akun' => 'bail|required',
            'supplier' => 'bail|required',
            'keterangan' => 'bail|required',
            'jumlah' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Hutang();
        $project->nomor = 'BYR-' . Str::random(5);
        $project->owner_id = Auth::user()->created_by;
        $project->akun_id = $request->akun;
        $project->supplier_id = $request->supplier;
        $project->keterangan = $request->keterangan;
        $project->tempo = $request->tanggal;
        $project->jumlah = $request->jumlah;
        $project->save();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hutang $hutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hutang $hutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'bail|required',
            'jumlah' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $data = Hutang::find($id);
        $data->retur = $request->retur;
        $data->keterangan = $request->keterangan;
        $data->tempo = $request->tanggal;
        $data->jumlah = $request->jumlah;
        $data->update();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Hutang::find($id);
        $data->delete();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'bayar' => 'bail|required',
        ]);
        $data = Hutang::find($id);
        $data->bayar = $request->bayar;
        $data->update();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil dibayar', 'level-alert' => 'alert-success']);
    }
}
