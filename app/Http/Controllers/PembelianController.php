<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Hutang;
use App\Models\Order;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        $orders = Order::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        $akuns = Akun::where('tambak_id', Auth::user()->tambak->first()->id)->get();
        return view('pembelian.index', compact('pembelian', 'orders', 'akuns'));
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
            'order' => 'bail|required',
            'akun' => 'bail|required',
            'tanggal' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $now = Carbon::now();
        $number = Pembelian::where('tambak_id', Auth::user()->tambak->first()->id)->where('tanggal', Carbon::today())->count();
        $project = new Pembelian();
        $project->nomor = 'LPB/' . $now->format('d') . $now->format('m') . '/' . $number + 1;
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->input_by = Auth::user()->id;
        $project->order_id = $request->order;
        $project->akun_id = $request->akun;
        $project->tanggal = $request->tanggal;
        $project->save();

        return redirect()->route('pembelian.index')->with(['pesan' => 'LPB berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data2 = Pembelian::find($id);
        $data3 = Hutang::where('pembelian_id', $data2->id)->first();

        if (isset($data3)) {
            $data3->delete();
        }
        $data2->delete();

        return redirect()->route('pembelian.index')->with(['pesan' => 'Pembelian berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
