<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecurityController;


// لوحة التحكم
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'admin']);


// تسجيل الدخول والتسجيل
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::view('/about', 'about')->name('about.index');


// مسارات تتطلب تسجيل دخول
Route::middleware(['auth'])->group(function () {
    // الفئات
    Route::resource('categories', CategoryController::class);

    // العناوين
    Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');
    Route::get('/address', [AddressController::class, 'index'])->name('address.index');

    // أنواع الفئات
    Route::resource('category-types', CategoryTypeController::class);

    // Clients
    Route::resource('clients', ClientController::class);

    // Tickets
    Route::resource('tickets', TicketController::class);

    // Profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Security
    Route::put('/password', [SecurityController::class, 'updatePassword'])->name('password.update');
    Route::post('/sessions/revoke', [SecurityController::class, 'revokeSession'])->name('sessions.revoke');
    Route::post('/sessions/logout-all', [SecurityController::class, 'logoutAllSessions'])->name('sessions.logout-all');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    
Route::post('/sessions/logout-all', [SettingsController::class, 'logoutAllSessions'])
    ->name('sessions.logout-all');
});
