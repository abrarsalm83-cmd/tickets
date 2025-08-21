<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // عرض الصفحة الرئيسية
    public function index()
    {
        return view('home');
    }
}

