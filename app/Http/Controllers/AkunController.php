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
        $akun = Akun::where('tambak_id', Auth::user()->tambak->first()->id)->get();

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
            'nomor' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Akun();
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->nama = $request->name;
        $project->nomor = $request->nomor;
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
    public function destroy($id)
    {
        $data = Akun::find($id);
        $data->delete();

        return redirect()->route('akun.index')->with(['pesan' => 'Akun berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
