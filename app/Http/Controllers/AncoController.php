<?php

namespace App\Http\Controllers;

use App\Models\Anco;
use App\Models\Pakan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AncoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolams = Auth::user()->tambak->first()->kolam->where('status', true);
        $pakans = Pakan::all();
        $anco = Anco::whereIn('kolam_id', $kolams->pluck('id'))->whereMonth('created_at', Carbon::now()->month)->get();

        return view('anco.index', compact('kolams', 'anco', 'pakans'));
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

        $project = new Anco();
        $project->kolam_id = $request->kolam;
        $project->user_id = Auth::user()->id;
        // If supplier dipilih
        $project->supplier_id = $request->supplier;
        $project->tanggal = $request->tanggal;
        $project->total = $request->total;
        $project->save();

        return redirect()->route('bibit.index', $request->tambak_id)->with(['pesan' => 'Data tebar bibit berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anco $anco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anco $anco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anco $anco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Anco::find($id);
        $data->delete();

        return redirect()->route('anco.index')->with(['pesan' => 'Data anco berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
