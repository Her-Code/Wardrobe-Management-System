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
    
        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            if (!$imagePath) {
                return back()->withErrors(['image' => 'Image upload failed.']);
            }
        } else {
            return back()->withErrors(['image' => 'No image file found.']);
        }
        
    
        // Store the new item in the database
        $clothingItem = ClothingItem::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'color' => $request->color,
            'image' => 'storage/' . $imagePath,
            'user_id' => auth()->id(),
        ]);
        
        // dd($clothingItem->image);
        // Return Inertia response with image URL
        return Inertia::render('clothing-items/Show', [
            'clothing_Item' => $clothingItem,
            'imageUrl' => asset($imagePath),
        ]);
    }
    
    public function show(ClothingItem $clothingItem)
    {
        return Inertia::render('ClothingItems/Show', [
            'clothingItem' => [
                'id' => $clothingItem->id,
                'name' => $clothingItem->name,
                'category' => $clothingItem->category,
                'size' => $clothingItem->size,
                'color' => $clothingItem->color,
                'image' => $clothingItem->image ? asset('storage/' . $clothingItem->image) : null,
            ]
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
