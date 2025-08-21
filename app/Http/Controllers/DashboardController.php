<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // إحصائيات التذاكر حسب الحالة (حذفنا pending, overdue)
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $inProgressTickets = Ticket::where('status', 'in_progress')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        // حساب التغيرات بالمقارنة بالشهر أو الأسبوع الماضي
        $lastMonth = Carbon::now()->subMonth();
        $lastWeek = Carbon::now()->subWeek();

        $totalTicketsLastMonth = Ticket::whereMonth('created_at', $lastMonth->month)
                                      ->whereYear('created_at', $lastMonth->year)
                                      ->count();

        $closedTicketsLastMonth = Ticket::where('status', 'closed')
                                       ->whereMonth('updated_at', $lastMonth->month)
                                       ->whereYear('updated_at', $lastMonth->year)
                                       ->count();

        $openTicketsLastWeek = Ticket::where('status', 'open')
                                    ->where('created_at', '>=', $lastWeek)
                                    ->count();

        $inProgressTicketsLastWeek = Ticket::where('status', 'in_progress')
                                          ->where('created_at', '>=', $lastWeek)
                                          ->count();

        $totalTicketsChange = $totalTicketsLastMonth > 0 ? 
            round((($totalTickets - $totalTicketsLastMonth) / $totalTicketsLastMonth) * 100) : 0;

        $openTicketsChange = $openTicketsLastWeek > 0 ? 
            round((($openTickets - $openTicketsLastWeek) / $openTicketsLastWeek) * 100) : 0;

        $inProgressTicketsChange = $inProgressTicketsLastWeek > 0 ? 
            round((($inProgressTickets - $inProgressTicketsLastWeek) / $inProgressTicketsLastWeek) * 100) : 0;

        $closedTicketsChange = $closedTicketsLastMonth > 0 ? 
            round((($closedTickets - $closedTicketsLastMonth) / $closedTicketsLastMonth) * 100) : 0;

        // التذاكر الحديثة
        $recentTickets = Ticket::with(['assignedTo', 'user'])
                              ->orderBy('created_at', 'desc')
                              ->limit(3)
                              ->get();

        // الأنشطة الحديثة (بأوقات حقيقية)
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact(
            'totalTickets',
            'openTickets', 
            'inProgressTickets',
            'closedTickets',
            'totalTicketsChange',
            'openTicketsChange',
            'inProgressTicketsChange',
            'closedTicketsChange',
            'recentTickets',
            'recentActivities'
        ));
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // التذاكر الجديدة
        $newTickets = Ticket::with('user')
                            ->where('created_at', '>=', Carbon::now()->subDays(7)) // آخر أسبوع
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();

        foreach ($newTickets as $ticket) {
            $activities->push([
                'icon' => 'fa-solid fa-ticket',
                'title' => 'New ticket created: "' . Str::limit($ticket->title, 40) . '"',
                'time' => $ticket->created_at->diffForHumans(),
                'created_at' => $ticket->created_at
            ]);
        }

        // التذاكر المغلقة
        $closedTickets = Ticket::with(['user', 'assignedTo'])
                               ->where('status', 'closed')
                               ->where('updated_at', '>=', Carbon::now()->subDays(7))
                               ->orderBy('updated_at', 'desc')
                               ->take(10)
                               ->get();

        foreach ($closedTickets as $ticket) {
            $activities->push([
                'icon' => 'fa-solid fa-circle-check',
                'title' => 'Ticket "' . Str::limit($ticket->title, 40) . '" closed',
                'time' => $ticket->updated_at->diffForHumans(),
                'created_at' => $ticket->updated_at
            ]);
        }

        // التذاكر المحدثة للحالة "في التقدم"
        $inProgressTickets = Ticket::with(['user', 'assignedTo'])
                                   ->where('status', 'in_progress')
                                   ->where('updated_at', '>=', Carbon::now()->subDays(7))
                                   ->where('updated_at', '!=', DB::raw('created_at'))
                                   ->orderBy('updated_at', 'desc')
                                   ->take(5)
                                   ->get();

        foreach ($inProgressTickets as $ticket) {
            $activities->push([
                'icon' => 'fa-solid fa-spinner',
                'title' => 'Ticket "' . Str::limit($ticket->title, 40) . '" in progress',
                'time' => $ticket->updated_at->diffForHumans(),
                'created_at' => $ticket->updated_at
            ]);
        }

        // التذاكر المعينة (إذا كان لديك حقل assigned_at)
        if (Schema::hasColumn('tickets', 'assigned_at')) {
            $assignedTickets = Ticket::with(['user', 'assignedTo'])
                                     ->whereNotNull('assigned_to')
                                     ->whereNotNull('assigned_at')
                                     ->where('assigned_at', '>=', Carbon::now()->subDays(7))
                                     ->orderBy('assigned_at', 'desc')
                                     ->take(5)
                                     ->get();

            foreach ($assignedTickets as $ticket) {
                $activities->push([
                    'icon' => 'fa-solid fa-user-gear',
                    'title' => 'Ticket assigned to ' . $ticket->assignedTo->name,
                    'time' => Carbon::parse($ticket->assigned_at)->diffForHumans(),
                    'created_at' => Carbon::parse($ticket->assigned_at)
                ]);
            }
        }

        // ترتيب الأنشطة حسب الوقت (الأحدث أولاً) وأخذ أحدث 8 أنشطة
        return $activities->sortByDesc('created_at')->take(8)->values();
    }
}