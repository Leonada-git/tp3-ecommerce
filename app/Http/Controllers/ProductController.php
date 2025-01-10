<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:products,sku|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'descriptions' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'create_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'weight' => $validated['weight'] ?? null,
            'descriptions' => $validated['descriptions'] ?? null,
            'thumbnail' => $validated['thumbnail'] ?? null,
            'image' => $validated['image'] ?? null,
            'category' => $validated['category'] ?? null,
            'create_date' => $validated['create_date'] ?? null,
            'stock' => $validated['stock'] ?? 0, 
        ]);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:products,sku,' . $id . '|max:255', 
            'price' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'descriptions' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'create_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
