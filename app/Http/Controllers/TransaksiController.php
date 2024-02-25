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

    public function history()
    {
        $barangs = Barang::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        $history = Transaksi::whereIn('barang_id', [$barangs])->get();

        return view('mutasi.index', compact('history'));
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
        if ($request->status == 'Pindah') {
            // Cari barang serupa di gudang tujuan
            $barang_lama = Barang::find($request->barang);
            $barangs = Barang::where('gudang_id', $request->gudang)->where('name', $barang_lama->name)->first();
            if (isset($barangs) == null) {
                $barang = new Barang();
                $barang->code = 'B-' . Str::random(5);
                $barang->name = $barang_lama->name;
                $barang->tambak_id = $barang_lama->tambak_id;
                $barang->kategori_id = $barang_lama->kategori_id;
                $barang->satuan_id = $barang_lama->satuan_id;
                $barang->gudang_id = $request->gudang;
                $barang->harga = $barang_lama->harga;
                $barang->supplier_id = $barang_lama->supplier_id;
                $barang->save();

                Transaksi::insert([
                    [
                        //Masuk
                        'barang_id' => $barang->id,
                        'input_by' => Auth::user()->id,
                        'status' => 'Masuk',
                        'catatan' => $request->catatan,
                        'kuantitas' => $request->kuantitas,
                    ],
                    [
                        //Keluar
                        'barang_id' => $barang_lama->id,
                        'input_by' => Auth::user()->id,
                        'status' => 'Keluar',
                        'catatan' => $request->catatan,
                        'kuantitas' => $request->kuantitas,
                    ]

                ]);
            } else {
                Transaksi::insert([
                    [
                        //Masuk
                        'barang_id' => $barangs->id,
                        'input_by' => Auth::user()->id,
                        'status' => 'Masuk',
                        'catatan' => $request->catatan,
                        'kuantitas' => $request->kuantitas,
                    ],
                    [
                        //Keluar
                        'barang_id' => $barang_lama->id,
                        'input_by' => Auth::user()->id,
                        'status' => 'Keluar',
                        'catatan' => $request->catatan,
                        'kuantitas' => $request->kuantitas,
                    ]

                ]);
            }
        } else {
            $project->barang_id = $request->barang;
            $project->input_by = Auth::user()->id;
            $project->status = $request->status;
            $project->catatan = $request->catatan;
            $project->kuantitas = $request->kuantitas;
            $project->save();
        }

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
