<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panen = Panen::where()->get();
        return view('panen.index', compact('panen'));
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
    public function show(Panen $panen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panen $panen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Panen $panen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panen $panen)
    {
        //
    }
}
