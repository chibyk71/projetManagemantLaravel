<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        Log::info("register called");
        // Ensure only authenticated admins can access this method
        // Example: Check if the authenticated user has the admin role
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20', // Adjust max length based on your needs
            'role' => 'required|string', // Ensure 'role' exists in your roles table
        ]);

        // Generate a random password for the new user
        function generateRandomPassword($length = 12)
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+[]{}|';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $password;
        }

        $password = generateRandomPassword();

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            "avatar"=> "avatars/default.png",
            'password' => Hash::make($password),
        ]);

        // Assign the role to the new user
        $user->assignRole($request->role);

        // Send the welcome email
        Mail::to($user->email)->send(new WelcomeMail($user, $password));
    }
}
