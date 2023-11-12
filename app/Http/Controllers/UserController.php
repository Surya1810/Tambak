<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tambak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('created_by', Auth::user()->id)->role('operator')->get();
        return view('operator.index', compact('users'));
    }

    public function owner()
    {
        $users = User::role('owner')->get();
        return view('owner.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operator.create');
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
            'phone' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->created_by = Auth::user()->id;
        $user->password = bcrypt('password');
        $user->assignRole('operator');
        $user->save();

        return redirect()->route('operator.index')->with(['pesan' => 'Operator berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }
    public function owner_store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required',
            'phone' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
