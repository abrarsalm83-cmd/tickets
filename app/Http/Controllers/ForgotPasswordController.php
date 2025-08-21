<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // عرض صفحة نسيان كلمة المرور
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // معالجة طلب إعادة تعيين كلمة المرور
    public function sendResetLinkEmail(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->email;

        // التحقق من وجود المستخدم
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'We could not find a user with that email address.');
        }

        // إنشاء رمز إعادة تعيين كلمة المرور
        $token = Str::random(64);
        $expiresAt = Carbon::now()->addHours(1); // انتهاء الصلاحية بعد ساعة

        // حفظ الرمز في قاعدة البيانات
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        // إرسال البريد الإلكتروني
        try {
            Mail::send('emails.reset-password', ['token' => $token, 'user' => $user], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset Password Notification');
            });

            return back()->with('success', 'We have emailed your password reset link.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send reset email. Please try again.');
        }
    }

    // عرض صفحة إعادة تعيين كلمة المرور
    public function showResetPasswordForm(Request $request, $token)
    {
        // التحقق من صحة الرمز
        $resetRecord = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(1))
            ->first();

        if (!$resetRecord) {
            return redirect()->route('password.request')->with('error', 'This password reset token is invalid or has expired.');
        }

        return view('auth.reset-password', ['token' => $token, 'email' => $resetRecord->email]);
    }

    // معالجة إعادة تعيين كلمة المرور
    public function resetPassword(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $token = $request->token;
        $email = $request->email;
        $password = $request->password;

        // التحقق من صحة الرمز
        $resetRecord = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('email', $email)
            ->where('created_at', '>', Carbon::now()->subHours(1))
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'This password reset token is invalid or has expired.');
        }

        // تحديث كلمة المرور
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($password)
            ]);

            // حذف الرمز من قاعدة البيانات
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            return redirect()->route('login')->with('success', 'Your password has been reset successfully. You can now login with your new password.');
        }

        return back()->with('error', 'Something went wrong. Please try again.');
    }
}
