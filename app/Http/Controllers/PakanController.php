<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\Kolam;
use App\Models\Pakan;
use App\Models\Tambak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);
        $pakan = Pakan::whereIn('kolam_id', $kolams->pluck('id'))->whereMonth('created_at', Carbon::now()->month)->get();

        return view('pakan.index', compact('kolams', 'pakan'));
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
            'kolam' => 'bail|required',
            'tanggal' => 'bail|required',
            'waktu' => 'bail|required',
            'jenis' => 'bail|required',
            'jumlah' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Bibit();
        $project->kolam_id = $request->kolam;
        $project->user_id = Auth::user()->id;
        $project->tanggal = $request->tanggal;
        $project->waktu = $request->waktu;
        $project->jenis = $request->jenis;
        $project->jumlah = $request->jumlah;
        $project->catatan = $request->catatan;
        $project->save();

        return redirect()->route('pakan.index')->with(['pesan' => 'Data pakan berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pakan $pakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pakan $pakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kolam' => 'bail|required',
            'tanggal' => 'bail|required',
            'waktu' => 'bail|required',
            'jenis' => 'bail|required',
            'jumlah' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = Bibit::find($id);
        $project->user_id = Auth::user()->id;
        $project->tanggal = $request->tanggal;
        $project->waktu = $request->waktu;
        $project->jenis = $request->jenis;
        $project->jumlah = $request->jumlah;
        $project->catatan = $request->catatan;
        $project->update();

        return redirect()->route('pakan.index')->with(['pesan' => 'Data pakan berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pakan::find($id);
        $data->delete();

        return redirect()->route('pakan.index')->with(['pesan' => 'Data pakan berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
