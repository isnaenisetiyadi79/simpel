<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('master.customer');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required|numeric',
            'address' => 'required|string'
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        return redirect()->route('master.customer')->with('success', 'Customer created succesfully');
    }
}
