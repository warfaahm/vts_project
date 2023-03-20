<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'nat_id_no' => ['required', 'string', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:10'],
            'phone_no' => ['required', 'string', 'max:255', 'unique:users'],
            'allergy' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'nat_id_no' => $validatedData['nat_id_no'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'phone_no' => $validatedData['phone_no'],
            'allergy' => $validatedData['allergy'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token'=> $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
