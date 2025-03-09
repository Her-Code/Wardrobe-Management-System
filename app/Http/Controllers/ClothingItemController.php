<?php

namespace App\Http\Controllers;
use App\Models\ClothingItem;
// use App\Http\Resources\ClothingItemResource;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


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
            'filters' => $request->all(),
        ]);
    }
    public function create()
    {
         // Get all categories for the category dropdown
        $categories = Category::all();

        return Inertia::render('ClothingItems/Create', [
            'categories' => $categories,
    ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle the image file upload
        $imagePath = $request->file('image')->store('images', 'public');
    
        // Create the new clothing item
        $clothingItem = ClothingItem::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'color' => $request->color,
            'image' => $imagePath, // Store the image path
            'user_id' => auth()->id(),
        ]);

        $imageUrl = Storage::url($imagePath);
        // Return the newly created clothing item as a response to Inertia
        return redirect()->route('clothing-items.show', [
            'clothing_Item' => $clothingItem->id,
        ])->with('imageUrl', $imageUrl);  // To pass the image URL to the view.
        
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
