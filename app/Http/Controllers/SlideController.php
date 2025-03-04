<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Get all slides.
     */
    public function index()
    {
        return response()->json(Slide::all(), 200);
    }

    /**
     * Store a new slide.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public');
            $request['image_url'] = asset('storage/' . $path);
        }

        $slide = Slide::create($request->only(['image_url']));
        return response()->json($slide, 201);
    }

    /**
     * Show a specific slide.
     */
    public function show($id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }
        return response()->json($slide, 200);
    }

    /**
     * Update a slide.
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }

        $request->validate([
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public');
            $slide->image_url = asset('storage/' . $path);
        } elseif ($request->has('image_url')) {
            $slide->image_url = $request->image_url;
        }

        $slide->save();
        return response()->json($slide, 200);
    }

    /**
     * Delete a slide.
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }

        $slide->delete();
        return response()->json(['message' => 'Slide deleted successfully'], 200);
    }
}