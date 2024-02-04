<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Hutang;
use App\Models\Pembelian;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hutang = Hutang::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        $pembelians = Pembelian::where('tambak_id', Auth::user()->tambak->first()->id)->get();

        return view('hutang.index', compact('hutang', 'pembelians'));
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
            'tanggal' => 'bail|required',
            'pembelian' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $now = Carbon::now();
        $number = Hutang::where('tambak_id', Auth::user()->tambak->first()->id)->where('tanggal', Carbon::today())->count();
        $project = new Hutang();
        $project->nomor = 'BYR/' . $now->format('d') . $now->format('m') . '/' . $number + 1;
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->pembelian_id = $request->pembelian;
        $project->tanggal = $request->tanggal;
        $project->save();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hutang $hutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hutang $hutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'retur' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $data = Hutang::find($id);
        $data->retur = $request->retur;
        $data->update();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Hutang::find($id);
        $data->delete();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil dihapus', 'level-alert' => 'alert-danger']);
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'bayar' => 'bail|required',
        ]);
        $data = Hutang::find($id);
        $data->bayar = $request->bayar;
        $data->update();

        return redirect()->route('hutang.index')->with(['pesan' => 'Hutang berhasil dibayar', 'level-alert' => 'alert-success']);
    }
}
