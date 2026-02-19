<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::with('category')->get();
        $totalCount = $resources->count(); 
        return view('resources.index', compact('resources', 'totalCount'));
    }

    public function create()
    {
        $categories = Category::all();
        $managers = User::all(); 
        return view('resources.create', compact('categories', 'managers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string', 
            'category_id' => 'required|exists:categories,id',
            'is_active'   => 'sometimes|boolean',
        ]);

        // Logic: Assign the current admin as the manager automatically
        $validatedData['manager_id'] = auth()->id();
        $validatedData['is_active'] = $request->input('is_active', true);

        Resource::create($validatedData);

        return redirect()->route('resources.index')->with('success', 'Hardware registered successfully.');
    }

    public function show(string $id)
    {
        $resource = Resource::with(['category'])->findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    public function toggleMaintenance($id)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isTechnician()) {
            abort(403);
        }
        $resource = Resource::findOrFail($id);
        $resource->is_active = !$resource->is_active; 
        $resource->save();
        return back()->with('success', 'Status updated.');
    }
    
    // ... keep edit, update, and destroy as they were
}