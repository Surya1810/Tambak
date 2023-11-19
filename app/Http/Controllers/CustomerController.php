<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::where('owner_id', Auth::user()->id)->where('status', '=', true)->get();

        return view('customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'address' => 'bail|required',
            'phone' => 'bail|required',
            'contact' => 'bail|required',
            'tempo' => 'bail|required',
        ]);

        $old = session()->getOldInput();

        $project = new Customer();
        $project->owner_id = Auth::user()->id;
        $project->code = 'GD-' . Str::random(5);
        $project->name = $request->name;
        $project->address = $request->address;
        $project->phone = $request->phone;
        $project->contact = $request->contact;
        $project->tempo = $request->tempo;
        $project->save();

        return redirect()->route('customer.index')->with(['pesan' => 'Customer berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('customer.edit', compact('customer'));
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


        $project = Customer::find($id);
        $project->name = $request->name;
        $project->address = $request->address;
        $project->phone = $request->phone;
        $project->contact = $request->contact;
        $project->tempo = $request->tempo;
        $project->update();

        return redirect()->route('customer.index')->with(['pesan' => 'Customer berhasil diubah', 'level-alert' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->status = false;
        $data->update();
        // $data->delete();

        return redirect()->route('customer.index')->with(['pesan' => 'Customer berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
