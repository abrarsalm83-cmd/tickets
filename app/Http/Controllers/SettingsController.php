<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SettingsController extends Controller
{
    // عرض صفحة الإعدادات مع الجلسات
    public function index()
    {
        $sessions = DB::table('sessions')
            ->where('user_id', auth()->id())
            ->select('id', 'ip_address', 'user_agent', 'last_activity')
            ->get()
            ->map(function ($session) {
                // نحول last_activity من رقم timestamp إلى تاريخ نسهل قراءته
                $session->last_seen = Carbon::createFromTimestamp($session->last_activity)->diffForHumans();

                // تحديد نوع الجهاز (Mobile / Desktop)
                if (str_contains(strtolower($session->user_agent), 'mobile')) {
                    $session->device = 'Mobile Device';
                } else {
                    $session->device = 'Desktop';
                }

                return $session;
            });

        return view('settings.index', compact('sessions'));
    }

    // تسجيل خروج من كل الجلسات بما فيها الحالية
    public function logoutAllSessions(Request $request)
    {
        $user = Auth::user();

        // حذف جميع الجلسات الخاصة بالمستخدم
        DB::table('sessions')->where('user_id', $user->id)->delete();

        // تسجيل خروج المستخدم الحالي
        Auth::logout();

        // مسح بيانات الجلسة
        Session::flush();

        // إعادة التوجيه لصفحة تسجيل الدخول
        return redirect('/login')->with('success', 'تم تسجيل الخروج من جميع الجلسات.');
    }

    // حذف جلسة محددة
    public function revokeSession(Request $request)
    {
        $sessionId = $request->input('session_id');

        DB::table('sessions')->where('id', $sessionId)->delete();

        return back()->with('success', 'تم إلغاء الجلسة المحددة.');
    }
}
