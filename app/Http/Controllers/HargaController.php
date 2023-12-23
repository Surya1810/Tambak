<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $harga = Harga::where('tambak_id', Auth::user()->tambak->first()->id)->get();

        return view('harga.index', compact('harga'));
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
            'size' => 'bail|required',
            'harga' => 'bail|required',
            'supplier' => 'bail|required',
            'mulai' => 'bail|required',
            'selesai' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Harga();
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->supplier_id = $request->supplier;
        $project->size = $request->size;
        $project->harga = $request->harga;
        $project->mulai = $request->mulai;
        $project->selesai = $request->selesai;
        $project->save();

        return redirect()->route('harga.index')->with(['pesan' => 'Data harga berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Harga $harga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Harga $harga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'bail|required',
            'harga' => 'bail|required',
            'supplier' => 'bail|required',
            'mulai' => 'bail|required',
            'selesai' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = Harga::find($id);
        $project->supplier_id = $request->supplier;
        $project->size = $request->size;
        $project->harga = $request->harga;
        $project->mulai = $request->mulai;
        $project->selesai = $request->selesai;
        $project->update();

        return redirect()->route('harga.index')->with(['pesan' => 'Data harga berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Harga::find($id);
        $data->delete();

        return redirect()->route('harga.index')->with(['pesan' => 'Data harga berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
