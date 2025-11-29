<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $request->password !== $user->password) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // For simplicity, we're not using tokens
        // In a real application, you would generate an API token here
        
        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        // For simplicity, we're not using tokens
        // In a real application, you would invalidate the API token here
        
        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
