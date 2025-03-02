<?php

namespace App\Http\Controllers;

use App\Models\New_Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = New_Users::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = New_Users::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:new__users,username',
            'role' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:new__users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = New_Users::create([
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function edit($id)
    {
        $newUser = New_Users::find($id);
        if (!$newUser) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return response()->json($newUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newUser = New_Users::find($id);
        if (!$newUser) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $request->validate([
            'username' => 'required|string|max:50|unique:new__users,username,' . $id,
            'role' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:new__users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        $newUser->username = $request->username;
        $newUser->role = $request->role;
        $newUser->email = $request->email;

        if ($request->has('password')) {
            $newUser->password_hash = Hash::make($request->password);
        }
        $newUser->save();
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $newUser
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $newUser = New_Users::find($id);
        if (!$newUser) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $newUser->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }

    
}
