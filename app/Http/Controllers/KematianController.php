<?php

namespace App\Http\Controllers;

use App\Models\Kematian;
use App\Models\Kolam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tambak = User::find(Auth::user()->id)->tambak->first()->id;
        $kolam = Kolam::where('tambak_id', $tambak)->pluck('id')->toArray();

        $kematian = Kematian::whereIn('kolam_id', $kolam)->get();
        return view('kematian.index', compact('kematian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);

        return view('kematian.create', compact('kolams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kolam' => 'bail|required',
            'tanggal' => 'bail|required',
            'umur' => 'bail|required',
            'total' => 'bail|required',
            'size' => 'bail|required',
            'jumlah' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Kematian();
        $project->owner_id = Auth::user()->created_by;
        $project->user_id = Auth::user()->id;
        $project->kolam_id = $request->kolam;
        $project->tanggal = $request->tanggal;
        $project->umur = $request->umur;
        $project->total = $request->total;
        $project->size = $request->size;
        $project->jumlah = $request->jumlah;
        $project->save();

        return redirect()->route('kematian.index')->with(['pesan' => 'Data kematian udang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kematian $kematian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kematian $kematian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kematian $kematian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kematian::find($id);
        $data->delete();

        return redirect()->route('kematian.index')->with(['pesan' => 'Data kematian udang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
