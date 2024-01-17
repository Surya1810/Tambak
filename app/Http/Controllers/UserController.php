<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tambak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('created_by', Auth::user()->id)->Role(['operator', 'akuntan'])->get();
        return view('operator.index', compact('users'));
    }

    public function owner()
    {
        $users = User::role('owner')->where('is_active', '=', true)->where('deleted_at', '=', null)->get();
        return view('owner.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owner_id = Auth::user()->created_by;
        $tambaks = Auth::user()->tambak->where('status', true);

        return view('operator.create', compact('tambaks'));
    }

    public function owner_create()
    {
        return view('owner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required|unique:users,email',
            'phone' => 'bail|required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'role' => 'bail|required',
            'tambak' => 'bail|required',
            'password' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = ltrim($request->phone, "0");
        $user->created_by = Auth::user()->id;
        $user->password = Hash::make($request->password);
        $user->assignRole($request->role);
        $user->save();
        $user->tambak()->attach($request->tambak);

        return redirect()->route('operator.index')->with(['pesan' => 'Karyawan berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    public function owner_store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required|unique:users,email',
            'phone' => 'bail|required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        $old = session()->getOldInput();

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = ltrim($request->phone, "0");
        $user->created_by = Auth::user()->id;
        $user->password = bcrypt('password');
        $user->assignRole('owner');
        $user->save();

        return redirect()->route('owner.index')->with(['pesan' => 'Owner berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $owner_id = Auth::user()->created_by;
        $tambaks = Auth::user()->tambak->where('status', true);

        $karyawan = User::find($id);

        return view('operator.edit', compact('tambaks', 'karyawan'));
    }
    public function owner_edit($id)
    {
        $owner = User::find($id);

        return view('owner.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'bail|required',
            'username' => 'bail|required|unique:users,username,' . $user->id,
            'email' => 'bail|required|unique:users,email,' . $user->id,
            'phone' => 'bail|required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'role' => 'bail|required',
            'tambak' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = ltrim($request->phone, "0");
        $user->syncRoles($request->role);
        $user->update();
        $user->tambak()->sync($request->tambak);

        return redirect()->route('operator.index')->with(['pesan' => 'Karyawan berhasil diubah', 'level-alert' => 'alert-warning']);
    }
    public function owner_update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'bail|required',
            'username' => 'bail|required|unique:users,username,' . $user->id,
            'email' => 'bail|required|unique:users,email,' . $user->id,
            'phone' => 'bail|required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = ltrim($request->phone, "0");
        $user->update();

        return redirect()->route('owner.index')->with(['pesan' => 'Owner berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->is_active = false;
        $data->update();

        $data->delete();

        return redirect()->route('operator.index')->with(['pesan' => 'Karyawan berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
    public function owner_destroy($id)
    {
        $data = User::find($id);
        $data->is_active = false;
        $data->update();

        $data->delete();

        return redirect()->route('owner.index')->with(['pesan' => 'Owner berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
