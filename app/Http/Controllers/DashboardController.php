<?php

namespace App\Http\Controllers;

use App\Models\Tambak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function admin()
    {
        $owner = User::role('owner')->count();
        $tambak = Tambak::where('status', '=', true)->count();

        return view('dashboard.admin', compact('owner', 'tambak'));
    }

    function owner()
    {
        $tambak = Auth::user()->tambak->where('status', '=', true);
        $karyawans = User::where('created_by', Auth::user()->id)->role('operator')->get();

        return view('dashboard.owner', compact('tambak', 'karyawans'));
    }
}
