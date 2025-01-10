<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::all();
        return response()->json($options, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'option_name' => 'required|string|max:255',
        ]);

        $option = Option::create([
            'option_name' => $validated['option_name'],
        ]);

        return response()->json($option, 201);
    }

    public function show($id)
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        return response()->json($option, 200);
    }

    public function update(Request $request, $id)
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        $validated = $request->validate([
            'option_name' => 'required|string|max:255',
        ]);

        $option->update($validated);

        return response()->json($option, 200);
    }

    public function destroy($id)
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        $option->delete();

        return response()->json(['message' => 'Option deleted successfully'], 200);
    }

    public function attachOptionToProduct($productId, $optionId)
    {
        $product = Product::find($productId);
        $option = Option::find($optionId);

        if (!$product || !$option) {
            return response()->json(['message' => 'Product or Option not found'], 404);
        }

        $product->options()->attach($option);

        return response()->json(['message' => 'Option attached to product successfully'], 200);
    }

    public function detachOptionFromProduct($productId, $optionId)
    {
        $product = Product::find($productId);
        $option = Option::find($optionId);

        if (!$product || !$option) {
            return response()->json(['message' => 'Product or Option not found'], 404);
        }

        $product->options()->detach($option);

        return response()->json(['message' => 'Option detached from product successfully'], 200);
    }
}
