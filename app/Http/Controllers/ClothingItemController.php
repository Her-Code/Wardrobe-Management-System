<?php

namespace App\Http\Controllers;
use App\Models\ClothingItem;
// use App\Http\Resources\ClothingItemResource;
use App\Models\Category;
use Inertia\Inertia;

use Illuminate\Http\Request;

class ClothingItemController extends Controller
{
    // public function index()
    // {
    //     $clothingItems = ClothingItemResource::collection(ClothingItem::all());
        
    //     return Inertia::render('ClothingItems/Index', [
    //         'clothingItems' => $clothingItems
    //     ]);
    // }

    public function index(Request $request)
    {
        $query = ClothingItem::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Pagination
        $clothingItems = $query->paginate(10);

        // Get all categories for the filter dropdown
        $categories = Category::all();

        return Inertia::render('ClothingItems/Index', [
            'clothingItems' => $clothingItems,
            'categories' => $categories,
            'filters' => $request->all(), // Pass filters to the view
        ]);
    }
    public function create()
    {
        return Inertia::render('ClothingItems/Create');
    }

    public function store(Request $request)
    {
        // Validate and create the clothing item
        ClothingItem::create($request->all());

        return redirect()->route('clothing-items.index');
    }

    public function show(ClothingItem $clothingItem)
    {
        return Inertia::render('ClothingItems/Show', [
            'clothingItem' => $clothingItem
        ]);
    }

    public function edit(ClothingItem $clothingItem)
    {
        return Inertia::render('ClothingItems/Edit', [
            'clothingItem' => $clothingItem
        ]);
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        // Validate and update the clothing item
        $clothingItem->update($request->all());

        return redirect()->route('clothing-items.index');
    }

    public function destroy(ClothingItem $clothingItem)
    {
        // Delete the clothing item
        $clothingItem->delete();

        return redirect()->route('clothing-items.index');
    }
}
