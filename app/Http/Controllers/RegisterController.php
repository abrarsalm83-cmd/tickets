<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // عرض صفحة التسجيل
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // معالجة البيانات عند التسجيل
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'birth_date' => ['required', 'date'],
        ]);

        // إنشاء مستخدم جديد
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'birth_date' => $validated['birth_date'],
            'is_admin' => 0, // مستخدم عادي
        ]);


        // ✅ هنا ضعي هذا السطر لتوجيه المستخدم بعد التسجيل
return redirect()->route('login')->with('success', 'Registered successfully, please log in.');
    }
}
