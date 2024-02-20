<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        $gudangs = Gudang::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', '=', true)->get();


        return view('mutasi.index', compact('barangs', 'gudangs'));
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
            'barang' => 'bail|required',
            'status' => 'bail|required',
            'catatan' => 'bail|required',
            'kuantitas' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Transaksi();
        $project->barang_id = $request->barang;
        $project->input_by = Auth::user()->id;
        $project->status = $request->status;
        $project->catatan = $request->catatan;
        $project->kuantitas = $request->kuantitas;
        $project->save();
        // if ($request->status == 'Pindah') {
        //     // Cari barang serupa di gudang lain
        //     $barang_lama = Barang::find($request->barang);
        //     $barangs = Barang::where('gudang_id', $request->gudang)->where('name', $barang_lama->name)->first()->id;
        //     if ($barangs = null) {
        //         $project = new Barang();
        //         $project->code = 'B-' . Str::random(5);
        //         $project->name = $barang_lama->name;
        //         $project->tambak_id = $barang_lama->tambak_id;
        //         $project->kategori_id = $barang_lama->kategori;
        //         $project->satuan_id = $barang_lama->satuan;
        //         $project->gudang_id = $request->gudang;
        //         $project->harga = $barang_lama->harga;

        //         //Masuk
        //         $project->barang_id = $barangs;
        //         $project->input_by = Auth::user()->id;
        //         $project->status = 'Masuk';
        //         $project->catatan = $request->catatan;
        //         $project->kuantitas = $request->kuantitas;
        //         $project->save();
        //     } else {
        //         //Keluar
        //         $project->barang_id = $request->barang;
        //         $project->input_by = Auth::user()->id;
        //         $project->status = 'Keluar';
        //         $project->catatan = $request->catatan;
        //         $project->kuantitas = $request->kuantitas;
        //         $project->save();

        //         //Masuk
        //         $project->barang_id = $barangs;
        //         $project->input_by = Auth::user()->id;
        //         $project->status = 'Masuk';
        //         $project->catatan = $request->catatan;
        //         $project->kuantitas = $request->kuantitas;
        //         $project->save();
        //     }
        // } else {
        //     $project->barang_id = $request->barang;
        //     $project->input_by = Auth::user()->id;
        //     $project->status = $request->status;
        //     $project->catatan = $request->catatan;
        //     $project->kuantitas = $request->kuantitas;
        //     $project->save();
        // }

        return redirect()->route('transaksi.index')->with(['pesan' => 'Transaksi berhasil dibuat', 'level-alert' => 'alert-success']);
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
