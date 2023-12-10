<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'kolam' => 'bail|required',
            'tanggal' => 'bail|required',
            'total' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Bibit();
        $project->kolam_id = $request->kolam_id;
        $project->user_id = Auth::user()->id;
        // If supplier dipilih
        $project->supplier_id = $request->supplier;
        $project->tanggal = $request->tanggal;
        $project->total = $request->total;
        $project->save();

        return redirect()->route('kolam', $request->tambak_id)->with(['pesan' => 'Data tebar bibit berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bibit $bibit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bibit $bibit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bibit $bibit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bibit $bibit)
    {
        //
    }
}
