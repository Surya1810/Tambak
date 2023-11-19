<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index', compact('kategori'));
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
            'name' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Kategori();
        $project->name = $request->name;
        $project->code = 'CT-' . Str::random(5);
        $project->save();

        return redirect()->route('kategori.index')->with(['pesan' => 'Kategori berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
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
        ]);

        $project = Kategori::find($id);
        $project->name = $request->name;

        $project->update();

        return redirect()->route('kategori.index')->with(['pesan' => 'Kategori berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kategori::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('kategori.index')->with(['pesan' => 'Kategori berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
