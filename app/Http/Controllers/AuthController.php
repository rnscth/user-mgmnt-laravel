<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'enabled' => true,
            'isAdmin' => false,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    /**
     * Authenticate user and generate a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            if (!$user->enabled){
                throw ValidationException::withMessages([
                    'email' => ['User disabled, please contact administrator.'],
                ]);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token , 'user' => $user]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }

    public function tokenVerify(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, return the user data
            return response()->json(['user' => Auth::user()]);
        } else {
            // User is not authenticated, return an error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
