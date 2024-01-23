<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Customer;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akuns = Akun::where('owner_id', Auth::user()->created_by)->get();
        $customers = Customer::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', '=', true)->get();
        $piutang = Piutang::where('owner_id', Auth::user()->created_by)->get();

        return view('piutang.index', compact('piutang', 'akuns', 'customers'));
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
            'akun' => 'bail|required',
            'customer' => 'bail|required',
            'keterangan' => 'bail|required',
            'jumlah' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Piutang();
        $project->nomor = 'BYR-' . Str::random(5);
        $project->owner_id = Auth::user()->created_by;
        $project->akun_id = $request->akun;
        $project->customer_id = $request->customer;
        $project->keterangan = $request->keterangan;
        $project->tempo = $request->tanggal;
        $project->jumlah = $request->jumlah;
        $project->save();

        return redirect()->route('piutang.index')->with(['pesan' => 'Piutang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Piutang $piutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Piutang $piutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'bail|required',
            'jumlah' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $data = Piutang::find($id);
        $data->retur = $request->retur;
        $data->keterangan = $request->keterangan;
        $data->tempo = $request->tanggal;
        $data->jumlah = $request->jumlah;
        $data->update();

        return redirect()->route('piutang.index')->with(['pesan' => 'Piutang berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Piutang::find($id);
        $data->delete();

        return redirect()->route('piutang.index')->with(['pesan' => 'Piutang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'bayar' => 'bail|required',
        ]);
        $data = Piutang::find($id);
        $data->bayar = $request->bayar;
        $data->update();

        return redirect()->route('piutang.index')->with(['pesan' => 'Piutang berhasil dibayar', 'level-alert' => 'alert-success']);
    }
}
