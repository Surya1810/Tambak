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


            // $kolam = $tambak[0]->kolam[0];
            // $doc = now()->diffInDays($kolam->bibit()->latest()->first()->tanggal);
            // $abw = 'berat' / 'jumlah';
            // $size = 1000 / $abw;
            // $adg = 'test';
            // $sr = 'populasi' * 1 / $kolam->bibit()->latest()->first()->total;
            // $total_pakan = $kolam->pakan()->latest()->first()->jumlah;
            // $biomassa = 'populasi' * $abw;
            // $fcr = $total_pakan / $biomassa;
            // $panen_kum = '-';

            // dd($doc);
            return view('dashboard.owner', compact('tambak'));
        }
    }
}
