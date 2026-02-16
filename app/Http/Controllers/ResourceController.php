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
        $resources = Resource::with('category')->get();
        return view('resources.index', compact('resources'));
    }

    /**
     * NEW: Toggle Hardware Maintenance Status
     */
    public function toggleMaintenance($id)
    {
        // Security: Only Techs or Admins can toggle status
        if (!auth()->user()->isAdmin() && !auth()->user()->isTechnician()) {
            abort(403, 'Unauthorized action.');
        }

        $resource = Resource::findOrFail($id);
        $resource->is_active = !$resource->is_active; // Flips 1 to 0 or 0 to 1
        $resource->save();

        return back()->with('success', 'Hardware status updated.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // Just getting all users who could manage, or you could filter by role 'manager'
        $managers = User::all(); 
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
        $resource = Resource::with(['category'])->findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resource = Resource::findOrFail($id);
        $categories = Category::all();
        $managers = User::all();
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
            'is_active' => 'boolean',
        ]);

        $resource = Resource::findOrFail($id);
        $resource->update($validatedData);

        return redirect()->route('resources.index')->with('success', 'Resource updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::findOrFail($id);
        $resource->delete();
        return redirect()->route('resources.index')->with('success', 'Resource deleted.');
    }
}