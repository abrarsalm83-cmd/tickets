@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">⚙️ Settings</h1>
            <p class="text-gray-600 mt-1 text-sm">Manage your preferences and application settings</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Navigation Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Settings Menu</h3>
                    <nav class="space-y-2">
                        <a href="#" onclick="showSection('profile')"
                           class="nav-link active flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
                            <span class="mr-3">👤</span>
                            Profile
                        </a>
                        <a href="#" onclick="showSection('security')"
                           class="nav-link flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
                            <span class="mr-3">🔒</span>
                            Security
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-sm border">
                    <!-- Profile Section -->
                    <div id="profile" class="section-content p-6">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                <span class="mr-2">👤</span>
                                Profile Settings
                            </h2>
                            <p class="text-gray-600 text-sm mt-1">Manage your personal information and account details</p>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" name="name"
                                           value="{{ old('name', auth()->user()->name ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                           required>
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" name="email"
                                           value="{{ old('email', auth()->user()->email ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                           required>
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Birthday</label>
                                    <input type="date" name="birth_date"
                                           value="{{ old('birth_date', auth()->user()->birth_date ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('birth_date') border-red-500 @enderror">
                                    @error('birth_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Section -->
                    <div id="security" class="section-content p-6 hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                <span class="mr-2">🔒</span>
                                Security Settings
                            </h2>
                            <p class="text-gray-600 text-sm mt-1">Keep your account secure and protected</p>
                        </div>

                        <div class="space-y-6">
                            <!-- Change Password -->
                            <div class="bg-white border rounded-lg p-4">
                                <h3 class="font-medium text-gray-800 mb-4">Change Password</h3>
                                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <input type="password" name="current_password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                                               required>
                                        @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" name="password"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                                   required>
                                            @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        Update Password
                                    </button>
                                </form>
                            </div>

                            <!-- Active Sessions -->
                            <div class="bg-white border rounded-lg p-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="font-medium text-gray-800">Active Sessions</h3>
                                    <form action="{{ route('sessions.logout-all') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                onclick="return confirm('Are you sure you want to logout from all devices?')">
                                            Logout All Sessions
                                        </button>
                                    </form>
                                </div>

                                <div class="space-y-3" id="sessions-list">
                                    <!-- Current Session -->
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-green-600 text-sm">🖥️</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Current Session</p>
                                                <p class="text-xs text-gray-500">{{ request()->userAgent() }} • {{ request()->ip() }}</p>
                                                <p class="text-xs text-gray-400">Active now</p>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded font-medium">Current</span>
                                    </div>

                                    @foreach ($sessions as $session)
                                        @if ($session->id !== session()->getId())
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-blue-600 text-sm">
    @php
        $ua = strtolower($session->user_agent);
        if (str_contains($ua, 'iphone') || str_contains($ua, 'android') || str_contains($ua, 'mobile')) {
            $icon = '📱';
        } elseif (str_contains($ua, 'ipad') || str_contains($ua, 'tablet')) {
            $icon = '📟';
        } else {
            $icon = '🖥️';
        }
    @endphp
    {{ $icon }}
</span>

                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-800">{{ $session->device ?? 'Unknown Device' }}</p>
                                                        <p class="text-xs text-gray-500">{{ $session->user_agent }} • {{ $session->ip_address }}</p>
                                                        <p class="text-xs text-gray-400">Last seen {{ Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <form action="{{ route('sessions.revoke') }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-800 text-xs font-medium"
                                                            onclick="return confirm('Are you sure you want to revoke this session?')">
                                                        Revoke
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-link { color: #6b7280; }
        .nav-link:hover { background-color: #f3f4f6; color: #374151; }
        .nav-link.active { background-color: #3b82f6; color: white; }
        .section-content.active { display: block !important; }
    </style>

    <script>
        function showSection(sectionName) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.classList.add('hidden'));
            document.getElementById(sectionName).classList.remove('hidden');

            const links = document.querySelectorAll('.nav-link');
            links.forEach(link => link.classList.remove('active'));
            event.target.closest('.nav-link').classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSection('profile');
        });
    </script>
</div>
@endsection
