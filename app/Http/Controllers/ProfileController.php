<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'birth_date' => 'nullable|date|before:today',
        ]);

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}