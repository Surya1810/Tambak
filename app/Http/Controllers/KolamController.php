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
    public function index($id)
    {
        // 
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

        return redirect()->route('tambak.owner')->with(['pesan' => 'Kolam berhasil ditambahkan', 'level-alert' => 'alert-success']);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'panjang' => 'bail|required',
            'lebar' => 'bail|required',
            'dalam' => 'bail|required',
            'anco' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = Kolam::find($id);;
        $project->name = $request->name;
        $project->panjang = $request->panjang;
        $project->lebar = $request->lebar;
        $project->kedalaman = $request->dalam;
        $project->anco = $request->anco;
        $project->luas = $request->panjang * $request->lebar;;
        $project->update();

        return redirect()->route('kolam', $request->tambak_id)->with(['pesan' => 'Kolam berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kolam::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->back()->with(['pesan' => 'Kolam berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
