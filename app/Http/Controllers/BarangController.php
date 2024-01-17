<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::where('tambak_id', Auth::user()->tambak->first()->id)->get();

        $categories = Kategori::all();
        $satuans = Satuan::all();
        $suppliers = Supplier::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', true)->get();
        $gudangs = Gudang::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', true)->get();

        return view('barang.index', compact('barang', 'satuans', 'categories', 'suppliers', 'gudangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'gudang' => 'bail|required',
            'kategori' => 'bail|required',
            'harga' => 'bail|required',
            'satuan' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Barang();
        $project->name = $request->name;
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->gudang_id = $request->gudang;
        $project->kategori_id = $request->kategori;
        $project->satuan_id = $request->satuan;
        $project->kuantitas = $request->kuantitas;
        $project->harga = $request->harga;
        // If supplier dipilih
        $project->supplier_id = $request->supplier;
        $project->save();

        return redirect()->route('barang.index')->with(['pesan' => 'Barang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'gudang' => 'bail|required',
            'kategori' => 'bail|required',
            'harga' => 'bail|required',
            'satuan' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = Barang::find($id);
        $project->name = $request->name;
        $project->gudang_id = $request->gudang2;
        $project->kategori_id = $request->kategori2;
        $project->satuan_id = $request->satuan2;
        $project->harga = $request->harga;
        // If supplier dipilih
        $project->supplier_id = $request->supplier;
        $project->update();

        return redirect()->route('barang.index')->with(['pesan' => 'Barang berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Barang::find($id);
        $data->delete();

        return redirect()->route('barang.index')->with(['pesan' => 'Barang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
