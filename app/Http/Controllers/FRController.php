<?php

namespace App\Http\Controllers;

use App\Models\FR;
use Illuminate\Http\Request;

class FRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frs = FR::all();
        return view('fr.index', compact('frs'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FR $fR)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FR $fR)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mbw' => 'bail|required',
            'fr' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = FR::find($id);
        $project->mbw = $request->mbw;
        $project->fr = $request->fr;
        $project->update();

        return redirect()->route('fr.index')->with(['pesan' => 'Data FR berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FR $fR)
    {
        //
    }
}
