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
    // public function index($id)
    // {
    //     $kolam = Kolam::where('tambak_id', $id)->get();

    //     return view('kolam.index', compact('kolam'));
    // }
    public function kolam($id)
    {
        $kolam = Kolam::where('tambak_id', $id)->get();
        $tambak_id = $id;

        return view('kolam.index', compact('kolam', 'tambak_id'));
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
        $request->validate([
            'name' => 'bail|required',
            'panjang' => 'bail|required',
            'lebar' => 'bail|required',
            'dalam' => 'bail|required',
            'anco' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Kolam();
        $project->tambak_id = $request->tambak_id;
        $project->name = $request->name;
        $project->panjang = $request->panjang;
        $project->lebar = $request->lebar;
        $project->kedalaman = $request->dalam;
        $project->anco = $request->anco;
        $project->luas = $request->panjang * $request->lebar;;
        $project->save();

        return redirect()->route('kolam', $request->tambak_id)->with(['pesan' => 'Kolam berhasil ditambahkan', 'level-alert' => 'alert-success']);
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
