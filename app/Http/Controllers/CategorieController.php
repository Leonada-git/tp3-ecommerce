<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();
        return response()->json($categories);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Typically, you would return a view for a form here. For simplicity:
        return response()->json(['message' => 'Display create form']);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        // Create a new category
        $category = Category::create($validated);

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        // Find the category by ID
        $category = Category::find($id);

        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        // Typically, you would return a view for the edit form. For simplicity:
        return response()->json(['message' => 'Display edit form']);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        // Update the category
        $category->update($validated);

        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Delete the category
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
