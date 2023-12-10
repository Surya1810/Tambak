<?php

namespace App\Http\Controllers;

use App\Models\Kolam;
use App\Models\Tambak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TambakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin()
    {
        $tambak = Tambak::where('status', '=', true)->get();

        return view('tambak.admin', compact('tambak'));
    }

    public function owner()
    {
        $tambak = Auth::user()->tambak->where('status', '=', true);

        return view('tambak.owner', compact('tambak'));
    }

    // public function user()
    // {
    //     $tambak = Tambak::where('status', '=', true)->get();

    //     return view('tambak.user', compact('tambak'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role('owner')->get();
        return view('tambak.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'address' => 'bail|required',
            'owner' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Tambak();
        $project->name = $request->name;
        $project->address = $request->address;
        // $project->user_id = $request->owner;
        $project->save();
        $project->owner()->attach($request->owner);

        return redirect()->route('tambak.admin')->with(['pesan' => 'Tambak berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tambak $tambak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tambak = Tambak::find($id);
        $users = User::role('owner')->get();
        return view('tambak.edit', compact('users', 'tambak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'address' => 'bail|required',
            'owner' => 'bail|required',
        ]);

        $project = Tambak::find($id);
        $project->name = $request->name;
        $project->address = $request->address;
        // $project->user_id = $request->owner;
        $project->update();
        $project->owner()->sync($request->owner);


        return redirect()->route('tambak.admin')->with(['pesan' => 'Tambak berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Tambak::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('tambak.admin')->with(['pesan' => 'Tambak berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
