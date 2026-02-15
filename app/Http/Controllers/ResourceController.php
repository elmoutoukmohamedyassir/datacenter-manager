<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $resources = \App\Models\Resource::with('category')->get();
    return view('resources.index', compact('resources'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $managers = User::where('is_active', true)->get();
        return view('resources.create', compact('categories', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'manager_id' => 'required|exists:users,id',
            'specifications' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        Resource::create($validatedData);

        return redirect()->route('resources.index')->with('success', 'Resource created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resource = Resource::with(['category', 'manager'])->findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resource = Resource::findOrFail($id);
        $categories = Category::all();
        $managers = User::where('is_active', true)->get();
        return view('resources.edit', compact('resource', 'categories', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'manager_id' => 'required|exists:users,id',
            'specifications' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $resource = Resource::findOrFail($id);
        $resource->update($validatedData);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::findOrFail($id);
        $resource->delete();
        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully');
    }
} 