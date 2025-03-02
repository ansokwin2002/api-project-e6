<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_type' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'description2' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imageName = basename($imagePath);
        }

        $item = Item::create([
            'item_type' => $request->item_type,
            'description' => $request->description,
            'description2' => $request->description2,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'image_url' => $request->image_url,
        ]);

        return response()->json([
            'message' => 'Item created successfully',
            'item' => $item
        ], 201);
    }

    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json($item);
    }
    

    public function edit($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'message' => 'Item not found'
            ], 404);
        }
        return response()->json($item);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $request->validate([
            'item_type' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'description2' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
        ]);
    
        $imageName = $item->image; 
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imageName = basename($imagePath);  
        }
        $item->update([
            'item_type' => $request->item_type,
            'description' => $request->description,
            'description2' => $request->description2,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'image_url' => $request->image_url,
        ]);
        
        return response()->json([
            'message' => 'Item updated successfully',
            'item' => $item
        ], 200);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

}
