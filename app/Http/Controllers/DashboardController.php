<?php

namespace App\Http\Controllers;

use App\Models\Tambak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function dashboard()
    {
        if (auth()->user()->hasRole('super admin|admin')) {
            $owner = User::role('owner')->count();
            $tambak = Tambak::all()->count();

            return view('dashboard.index', compact('owner', 'tambak'));
        } elseif (auth()->user()->hasRole('owner')) {
            $tambak = Auth::user()->tambak;

            return view('dashboard.index', compact('tambak'));
        } else {
            return view('dashboard.index');
        }
    }
}
