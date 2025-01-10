<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function create()
    {
        return response()->json(['message' => 'Display create form']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|decimal:0,2',
            'shipping_address' => 'nullable|string',
            'order_address' => 'nullable|string',
            'order_email' => 'nullable|email',
            'order_date' => 'nullable|date',
            'order_status' => 'nullable|string',
        ]);

        $order = Order::create($validated);
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if ($order) {
            return response()->json($order);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    public function edit($id)
    {
        return response()->json(['message' => 'Display edit form']);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|decimal:0,2',
            'shipping_address' => 'nullable|string',
            'order_address' => 'nullable|string',
            'order_email' => 'nullable|email',
            'order_date' => 'nullable|date',
            'order_status' => 'nullable|string',
        ]);

        $order->update($validated);
        return response()->json(['message' => 'Order updated successfully', 'order' => $order]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
