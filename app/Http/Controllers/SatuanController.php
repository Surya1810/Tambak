<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::where('status', '=', true)->get();

        return view('satuan.index', compact('satuan'));
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
            'code' => 'bail|required',
            'name' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Satuan();
        $project->name = $request->name;
        $project->code = $request->code;
        $project->save();

        return redirect()->route('satuan.index')->with(['pesan' => 'Satuan berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'bail|required',
            'name' => 'bail|required',
        ]);

        $project = Satuan::find($id);
        $project->name = $request->name;
        $project->code = $request->code;
        $project->update();

        return redirect()->route('satuan.index')->with(['pesan' => 'Satuan berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Satuan::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('satuan.index')->with(['pesan' => 'Satuan berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
