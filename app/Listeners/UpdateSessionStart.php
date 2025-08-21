<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class UpdateSessionStart
{
    public function handle(Login $event)
    {
        DB::table('sessions')
            ->where('user_id', $event->user->id)
            ->latest('last_activity')
            ->limit(1)
            ->update(['started_at' => now()]);
    }
}
