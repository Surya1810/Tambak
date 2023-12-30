<?php

namespace App\Http\Controllers;

use App\Models\Anco;
use App\Models\Pakan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AncoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);
        $anco = Anco::whereIn('kolam_id', $kolams->pluck('id'))->whereMonth('created_at', Carbon::now()->month)->get();

        return view('anco.index', compact('kolams', 'anco'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);
        if (isset($tanggal)) {

            $pakans = Pakan::whereDate('tanggal', $tanggal)->get();
        } else {
            $pakans = Pakan::all();
        }

        return view('anco.create', compact('kolams', 'pakans'));
    }

    public function pakan($kolam, $tanggal)
    {
        $dataPakan = Pakan::where('kolam_id', $kolam)->whereDate('tanggal', $tanggal)->get();

        // Memformat waktu menggunakan Carbon
        foreach ($dataPakan as $pakan) {
            $pakan->formattedWaktu = Carbon::parse($pakan->waktu)->format('h:i');
        }

        return response()->json($dataPakan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kolam' => 'bail|required',
            'tanggal' => 'bail|required',
            'pakan' => 'bail|required',
            'waktu' => 'bail|required',
            'anco_1' => 'bail|required',
            'anco_2' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Anco();
        $project->user_id = Auth::user()->id;
        $project->kolam_id = $request->kolam;
        $project->pakan_id = $request->pakan;
        // If supplier dipilih
        $project->tanggal = $request->tanggal;
        $project->waktu = $request->waktu;
        $project->anco_1 = $request->anco_1;
        $project->anco_2 = $request->anco_2;
        $project->save();

        return redirect()->route('anco.index')->with(['pesan' => 'Data cek anco berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anco $anco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anco $anco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anco $anco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Anco::find($id);
        $data->delete();

        return redirect()->route('anco.index')->with(['pesan' => 'Data anco berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
