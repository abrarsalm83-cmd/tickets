<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // عرض فورم إضافة عنوان
    public function create()
    {
        return view('address.create');  // عرض صفحة الفورم لإضافة عنوان جديد
    }

    // حفظ العنوان الجديد
    public function store(Request $request)
    {
        // تحقق من البيانات المدخلة
        $request->validate([
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'details' => 'nullable|string',
        ]);

        // إضافة العنوان إلى قاعدة البيانات
        Address::create([
            'user_id' => Auth::id(), // ربط العنوان بالمستخدم الحالي
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'postal_code' => $request->postal_code,
            'details' => $request->details,
        ]);

        // إعادة توجيه المستخدم إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('home')->with('success', 'تم إضافة العنوان بنجاح');
    }

    // عرض عناوين المستخدم
    public function show()
    {
        $addresses = Auth::user()->addresses;  // جلب العناوين المرتبطة بالمستخدم الحالي
        return view('address.index', compact('addresses'));  // عرض العناوين في صفحة عرض العناوين
    }
}