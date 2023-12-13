<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::where('owner_id', Auth::user()->id)->where('status', '=', true)->get();

        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'address' => 'bail|required',
            'phone' => 'bail|required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'contact' => 'bail|required',
            'tempo' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Supplier();
        $project->owner_id = Auth::user()->id;
        $project->code = 'GD-' . Str::random(5);
        $project->name = $request->name;
        $project->address = $request->address;
        $project->phone = (int)$request->phone;
        $project->contact = $request->contact;
        $project->tempo = $request->tempo;
        $project->save();

        return redirect()->route('supplier.index')->with(['pesan' => 'Supplier berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'address' => 'bail|required',
            'phone' => 'bail|required',
            'contact' => 'bail|required',
            'tempo' => 'bail|required',
        ]);


        $project = Supplier::find($id);
        $project->name = $request->name;
        $project->address = $request->address;
        $project->phone = (int)$request->phone;
        $project->contact = $request->contact;
        $project->tempo = $request->tempo;
        $project->update();

        return redirect()->route('supplier.index')->with(['pesan' => 'Supplier berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Supplier::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('supplier.index')->with(['pesan' => 'Supplier berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
