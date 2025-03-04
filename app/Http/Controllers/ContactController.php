<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Contact::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contact = Contact::create($request->validate([
            'location'=>'required|string|max:255',
            'phone_number'=> 'required|string|max:30',
            'email' => 'required|string|max:50',
            'link' => 'nullable|string|max:150',


        ]));
        return response()->json([
            'message'=>'created',
            'contact'=>$contact
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Contact::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:contacts,email,'.$id,
            'phone' => 'nullable|string',
        ]));
        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return response()->json(['message'=>'deleted']);
    }
}
