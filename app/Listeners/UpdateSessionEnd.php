<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;

class UpdateSessionEnd
{
    public function handle(Logout $event)
    {
        DB::table('sessions')
            ->where('user_id', $event->user->id)
            ->latest('last_activity')
            ->limit(1)
            ->update(['ended_at' => now()]);
    }
}
