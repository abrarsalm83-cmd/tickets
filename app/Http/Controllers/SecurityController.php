<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class SecurityController extends Controller
{
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Log out all other sessions
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', Session::getId())
            ->delete();

        return redirect()->back()->with('success', 'Password updated successfully! All other sessions have been logged out.');
    }

    /**
     * Get all active sessions for the user.
     */
    public function getSessions()
    {
        $user = Auth::user();
        $currentSessionId = Session::getId();
        
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->get()
            ->map(function ($session) {
                $payload = unserialize(base64_decode($session->payload));
                
                return [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'user_agent' => $this->parseUserAgent($session->user_agent),
                    'device' => $this->getDeviceType($session->user_agent),
                    'last_activity' => $this->formatLastActivity($session->last_activity),
                ];
            });

        return $sessions;
    }

    /**
     * Revoke a specific session.
     */
    public function revokeSession(Request $request)
    {
        $user = Auth::user();
        $sessionId = $request->session_id;

        // Don't allow revoking current session
        if ($sessionId === Session::getId()) {
            return redirect()->back()->withErrors(['error' => 'Cannot revoke current session.']);
        }

        // Delete the session
        $deleted = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', $sessionId)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Session revoked successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Session not found or already expired.']);
    }

    /**
     * Logout from all sessions except current.
     */
    public function logoutAllSessions(Request $request)
    {
        $user = Auth::user();
        $currentSessionId = Session::getId();

        // Delete all sessions except current
        $deletedCount = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return redirect()->back()->with('success', "Logged out from {$deletedCount} other sessions successfully.");
    }

    /**
     * Parse user agent to get readable browser/device info.
     */
    private function parseUserAgent($userAgent)
    {
        // Simple user agent parsing
        if (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome Browser';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox Browser';
        } elseif (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) {
            return 'Safari Browser';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return 'Edge Browser';
        } elseif (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false) {
            return 'Mobile App';
        }
        
        return 'Unknown Browser';
    }

    /**
     * Get device type from user agent.
     */
    private function getDeviceType($userAgent)
    {
        if (strpos($userAgent, 'Mobile') !== false || 
            strpos($userAgent, 'Android') !== false || 
            strpos($userAgent, 'iPhone') !== false) {
            return 'Mobile Device';
        } elseif (strpos($userAgent, 'Tablet') !== false || strpos($userAgent, 'iPad') !== false) {
            return 'Tablet';
        }
        
        return 'Desktop';
    }

    /**
     * Format last activity timestamp.
     */
    private function formatLastActivity($timestamp)
    {
        $lastActivity = \Carbon\Carbon::createFromTimestamp($timestamp);
        return $lastActivity->diffForHumans();
    }
}