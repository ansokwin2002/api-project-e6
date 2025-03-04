<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AboutUs::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aboutUs = AboutUs::create($request->validate([
            'user_id' => 'required|integer',
            'detail_about_us' => 'required|string|max:255',
            'detail_about_us_2' => 'required|string|max:255',
        ]));
        


        return response()->json($aboutUs, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $aboutUs = AboutUs::find($id);
        if (!$aboutUs) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($aboutUs, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $aboutUs = AboutUs::find($id);
    if (!$aboutUs) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    $validatedData = $request->validate([
        'user_id' => 'sometimes|integer',
        'detail_about_us' => 'sometimes|string|max:255',
        'detail_about_us_2' => 'sometimes|string|max:255',
    ]);

    $aboutUs->update($validatedData);

    return response()->json(['message' => 'About Us updated successfully', 'aboutUs' => $aboutUs], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aboutUs = AboutUs::find($id);
        if (!$aboutUs) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $aboutUs->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
