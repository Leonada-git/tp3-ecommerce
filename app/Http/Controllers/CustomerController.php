<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function create()
    {
        return response()->json(['message' => 'Display create form']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
            'billing_address' => 'nullable|string',
            'default_shipping_address' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $customer = Customer::create($validated);

        return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    public function edit($id)
    {
        return response()->json(['message' => 'Display edit form']);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'email' => 'required|email|unique:customers,email,' . $id,
            'password' => 'nullable|string|min:8',
            'full_name' => 'required|string|max:255',
            'billing_address' => 'nullable|string',
            'default_shipping_address' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);

        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
