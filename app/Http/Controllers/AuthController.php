<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function signup(Request $request): JsonResponse
    {
        // Validate request using validator
        $validator = validator($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'phone.required' => 'Phone is required',
        ]);

        // Return error if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid request',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new user
        $user = new User();
        $user->name = explode('@', $request->email)[0];
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->role = 'user'; // user
        $user->save();

        return response()->json([
            'message' => 'Signup successful, please login',
        ], 200);
    }

    public function login(Request $request): JsonResponse
    {
        // Validate email is role user
        $user = User::where('email', $request->email)->first();
        if ($user && $user->role !== 'user') {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        // Validate credentials
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'message' => 'Login successful',
        ], 200);
    }

    public function redirectProvider($provider = 'google')
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackGoogle()
    {
        $userSocialite = Socialite::driver('google')->user();
        $user = User::where('email', $userSocialite->getEmail())->first();

        if($user){
            auth()->login($user, true);

            return redirect('home')->with(['success' => 'Login successful']);
        }

        $user = User::create([
            'email'             => $userSocialite->getEmail(),
            'name'              => $userSocialite->getName(),
            'password'          => 0,
            'email_verified_at' => now()
        ]);

        auth()->login($user, true);

        return redirect('home')->with(['success' => 'Login successful']);
    }
}
