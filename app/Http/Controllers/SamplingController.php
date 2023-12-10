<?php

namespace App\Http\Controllers;

use App\Models\Sampling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SamplingController extends Controller
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
            'mbw' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Sampling();
        $project->kolam_id = $request->kolam_id;
        $project->user_id = Auth::user()->id;
        $project->tanggal = $request->tanggal;
        $project->mbw = $request->mbw;
        $project->catatan = $request->catatan;
        $project->save();

        return redirect()->route('kolam', $request->tambak_id)->with(['pesan' => 'Data sampling berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sampling $sampling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sampling $sampling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sampling $sampling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sampling $sampling)
    {
        //
    }
}
