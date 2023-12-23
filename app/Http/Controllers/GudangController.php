<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tambak = Auth::user()->tambak->first()->id;
        $gudang = Gudang::where('tambak_id', $tambak)->where('status', '=', true)->get();

        return view('gudang.index', compact('gudang'));
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
            'desc' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Gudang();
        $project->name = $request->name;
        $project->code = 'GD-' . Str::random(5);
        $project->desc = $request->desc;
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->save();

        return redirect()->route('gudang.index')->with(['pesan' => 'Gudang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gudang $gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gudang $gudang)
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
            'desc' => 'bail|required',
        ]);

        $project = Gudang::find($id);
        $project->name = $request->name;
        $project->desc = $request->desc;
        $project->update();

        return redirect()->route('gudang.index')->with(['pesan' => 'Gudang berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Gudang::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('gudang.index')->with(['pesan' => 'Gudang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
