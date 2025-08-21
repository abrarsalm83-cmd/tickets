<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // معالجة بيانات تسجيل الدخول
    public function login(Request $request)
    {
        // التحقق من صحة البيانات
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            // نجاح الدخول
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // فشل تسجيل الدخول
        return back()->with('error', 'Login credentials are incorrect');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login'); // ✅ هذا هو الصحيح
    }
}
