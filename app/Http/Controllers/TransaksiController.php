<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mutasi = Transaksi::all();

        return view('mutasi.index', compact('mutasi'));
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'gudang2' => 'bail|required',
            'kategori2' => 'bail|required',
            'harga' => 'bail|required',
            'satuan2' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Transaksi();
        $project->barang_id = $request->id;
        $project->input_by = Auth::user()->id;
        $project->status = $request->status;
        $project->catatan = $request->catatan;
        $project->kuantitas = $request->kuantitas;
        $project->save();

        return redirect()->route('barang.index')->with(['pesan' => 'Barang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
