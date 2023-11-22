<?php

namespace App\Http\Controllers;

use App\Models\Kolam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KolamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolam = Kolam::where('tambak_id')->get();

        return view('kolam.index', compact('kolam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tambak = Auth::user()->tambak;

        return view('kolam.create', compact('tambak'));
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
    public function show(Kolam $kolam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolam $kolam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kolam $kolam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kolam $kolam)
    {
        //
    }
}
