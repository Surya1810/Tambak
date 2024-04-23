<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hutang;
use App\Models\Order;
use App\Models\Pembelian;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PO = Order::where('tambak_id', Auth::user()->tambak->first()->id)->get();

        return view('purchase.index', compact('PO'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('tambak_id', Auth::user()->tambak->first()->id)->where('status', '=', true)->get();
        $barangs = Barang::where('tambak_id', Auth::user()->tambak->first()->id)->get();

        return view('purchase.create', compact('suppliers', 'barangs'));
    }

    public function supplier($supplier)
    {
        $dataBarang = Barang::where('supplier_id', $supplier)->get();

        return response()->json($dataBarang);
    }
    public function barang($barang)
    {
        $Barang = Barang::find($barang);

        return response()->json($Barang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'bail|required',
            'tanggal' => 'bail|required',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $old = session()->getOldInput();

        //Nota PO
        $now = Carbon::now();
        $number = Order::where('tambak_id', Auth::user()->tambak->first()->id)->where('tanggal', Carbon::today())->count();
        $project = new Order();
        $project->nomor = 'PO/' . $now->format('d') . $now->format('m') . '/' . $number + 1;
        $project->tambak_id = Auth::user()->tambak->first()->id;
        $project->input_by = Auth::user()->id;
        $project->supplier_id = $request->supplier;
        $project->keterangan = $request->keterangan;
        $project->tanggal = $request->tanggal;
        $project->status = 'Draft';
        $project->save();

        //Item Po
        $project->items()->createMany($request->items);

        return redirect()->route('PO.index')->with(['pesan' => 'PO berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'harga' => 'bail|required',
            'tanggal' => 'bail|required',
            'keterangan' => 'bail|required',
            'qty' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = Order::find($id);
        $project->tanggal = $request->tanggal;
        $project->harga = $request->harga;
        $project->qty = $request->qty;
        $project->keterangan = $request->keterangan;
        $project->update();

        return redirect()->route('PO.index')->with(['pesan' => 'Data PO berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Order::find($id);
        $data2 = Pembelian::where('order_id', $data->id)->first();
        if (isset($data2)) {
            $data3 = Hutang::where('pembelian_id', $data2->id)->first();
        }

        if (isset($data3)) {
            $data3->delete();
        }
        if (isset($data2)) {
            $data2->delete();
        }
        $data->delete();

        return redirect()->route('PO.index')->with(['pesan' => 'PO berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
