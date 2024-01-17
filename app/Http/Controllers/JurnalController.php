<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnal = Jurnal::where()->get();
        return view('jurnal.index', compact('jurnal'));
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
            'nominal' => 'bail|required',
            'keterangan' => 'bail|required',
            'aktivitas' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Jurnal();
        $project->owner_id = Auth::user()->created_by;
        $project->akun_id = $request->akun_id;
        $project->input_by = Auth::user()->id;
        $project->nominal = $request->nominal;
        $project->keterangan = $request->keterangan;
        $project->aktivitas = $request->aktivitas;
        $project->tanggal = $request->tanggal;
        $project->save();

        return redirect()->route('jurnal.index')->with(['pesan' => 'Transaksi berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurnal $jurnal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurnal $jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Jurnal::find($id);
        $data->delete();

        return redirect()->route('jurnal.index')->with(['pesan' => 'Transaksi berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
