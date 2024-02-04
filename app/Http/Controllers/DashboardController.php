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
            $tambak = Tambak::where('status', '=', true)->count();

            return view('dashboard.admin', compact('owner', 'tambak'));
        } else if (auth()->user()->hasRole('owner|operator|manager|akuntan')) {
            $tambak = Auth::user()->tambak->where('status', '=', true);
            return view('dashboard.owner', compact('tambak'));
        }
    }
}
