<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Registration Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'user')->first()->id, // Default role
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard
        return redirect()->route('home')->with('success', 'Registration successful! Welcome to the application.');
    }
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Handle Login
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to the dashboard
            // Role-based redirection
            return match(Auth::user()->role->name) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'organizer' => redirect()->intended('/organizer/dashboard'),
                default => redirect()->intended('home'),
            };
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
    // Handle Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout successful! See you next time.');
    }




}
