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
     * Accessible by guests and authenticated users.
     */
    public function index()
    {
        // Eager load category to prevent N+1 query issues (Pro-tip for the prof!)
        $resources = Resource::with('category')->get();
        
        // This makes the 'Total managed assets' counter on your front-end live
        $totalCount = $resources->count(); 
        
        return view('resources.index', compact('resources', 'totalCount'));
    }

    /**
     * Toggle Hardware Maintenance Status
     */
    public function toggleMaintenance($id)
    {
        // Logic remains the same: restrict to Admins or Techs
        if (!auth()->user()->isAdmin() && !auth()->user()->isTechnician()) {
            abort(403, 'Unauthorized action.');
        }

        $resource = Resource::findOrFail($id);
        $resource->is_active = !$resource->is_active; 
        $resource->save();

        return back()->with('success', 'Hardware status updated.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
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
            'type' => 'required|string', 
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
            'type' => 'required|string',
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