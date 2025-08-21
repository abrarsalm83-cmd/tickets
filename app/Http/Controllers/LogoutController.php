<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Handle user logout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log the logout activity
        if (Auth::check()) {
            $user = Auth::user();
            Log::info('User logged out', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'timestamp' => now()
            ]);
        }

        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Clear all session data
        Session::flush();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    /**
     * Show the login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Log the login activity
            Log::info('User logged in', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'timestamp' => now()
            ]);

            return redirect()->intended('dashboard')->with('success', 'مرحباً بك مرة أخرى!');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    /**
     * Force logout from all devices (optional)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutFromAllDevices(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Log the activity
            Log::info('User logged out from all devices', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'timestamp' => now()
            ]);

            // Invalidate all sessions for this user
            Auth::logoutOtherDevices($request->password);

            // Logout current session
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login')->with('success', 'تم تسجيل الخروج من جميع الأجهزة بنجاح');
    }
}