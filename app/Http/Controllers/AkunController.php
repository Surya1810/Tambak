<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = Akun::all();

        return view('akun.index', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'aktivitas' => 'bail|required',
            'jenis' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Akun();
        if (Auth::user()->created_by != null) {
            $project->owner_id = Auth::user()->created_by;
        } else {
            $project->owner_id = Auth::user()->id;
        }
        if ($request->aktivitas == 'kredit') {
            $project->nomor = 'CR-' . Str::random(5);
        } else {
            $project->nomor = 'DB-' . Str::random(5);
        }
        $project->nama = $request->name;
        $project->aktivitas = $request->aktivitas;
        $project->jenis = $request->jenis;
        $project->save();

        return redirect()->route('akun.index')->with(['pesan' => 'Akun berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        //
    }
}
