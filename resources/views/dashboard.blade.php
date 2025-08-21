@extends('layouts.app')
@section('content')
    <!-- Dashboard Stats -->
    <div class="dashboard-grid">
        <!-- Total Tickets -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title">Total Tickets</div>
                <div class="card-icon"><i class="fa-solid fa-ticket"></i></div>
            </div>
            <div class="card-value">{{ $totalTickets }}</div>
            <div class="card-subtitle">All time</div>
            <div class="card-trend {{ $totalTicketsChange >= 0 ? 'trend-up' : 'trend-down' }}">
                <i class="fa-solid fa-arrow-{{ $totalTicketsChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($totalTicketsChange) }}% from last month
            </div>
        </div>

        <!-- Open Tickets -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title">Open Tickets</div>
                <div class="card-icon"><i class="fa-solid fa-folder-open"></i></div>
            </div>
            <div class="card-value">{{ $openTickets }}</div>
            <div class="card-subtitle">Awaiting resolution</div>
            <div class="card-trend {{ $openTicketsChange >= 0 ? 'trend-up' : 'trend-down' }}">
                <i class="fa-solid fa-arrow-{{ $openTicketsChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($openTicketsChange) }}% this week
            </div>
        </div>

        <!-- In Progress Tickets -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title">In Progress</div>
                <div class="card-icon"><i class="fa-solid fa-spinner"></i></div>
            </div>
            <div class="card-value">{{ $inProgressTickets }}</div>
            <div class="card-subtitle">Currently processing</div>
            <div class="card-trend {{ $inProgressTicketsChange >= 0 ? 'trend-up' : 'trend-down' }}">
                <i class="fa-solid fa-arrow-{{ $inProgressTicketsChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($inProgressTicketsChange) }}% this week
            </div>
        </div>

        <!-- Closed Tickets -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title">Closed Tickets</div>
                <div class="card-icon"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <div class="card-value">{{ $closedTickets }}</div>
            <div class="card-subtitle">Resolved issues</div>
            <div class="card-trend {{ $closedTicketsChange >= 0 ? 'trend-up' : 'trend-down' }}">
                <i class="fa-solid fa-arrow-{{ $closedTicketsChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($closedTicketsChange) }}% from last month
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-section">
        <div class="section-header">
            <div class="section-title">Quick Actions</div>
        </div>
        <div class="quick-actions">
               <a href="{{ route('category-types.index') }}" class="quick-action">
                <div class="quick-action-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="quick-action-title">Category Types</div>
            </a>
            <a href="{{ route('categories.index') }}" class="quick-action">
                <div class="quick-action-icon"><i class="fa-solid fa-tags"></i></div>
                <div class="quick-action-title">Categories</div>
            </a>
            <a href="{{ route('tickets.create') }}" class="quick-action">
                <div class="quick-action-icon"><i class="fa-solid fa-plus"></i></div>
                <div class="quick-action-title">Create Ticket</div>
            </a>
         
       
            <a href="{{ route('clients.index') }}" class="quick-action">
                <div class="quick-action-icon"><i class="fa-solid fa-users"></i></div>
                <div class="quick-action-title">Clients</div>
            </a>
                 <a href="{{ route('settings.index') }}" class="quick-action">
                <div class="quick-action-icon"><i class="fa-solid fa-gear"></i></div>
                <div class="quick-action-title">System Settings</div>
            </a>
        </div>
    </div>

    <!-- Recent Tickets -->
    <div class="content-section">
        <div class="section-header">
            <div class="section-title">Recent Tickets</div>
            <a href="{{ route('tickets.index') }}" class="btn btn-primary">View All</a>
        </div>
        <div class="events-grid">
            @forelse($recentTickets as $ticket)
                <div class="event-card">
                    <div class="event-header">
                        <div>
                            <div class="event-title">{{ $ticket->title }}</div>
                            <div class="event-date">{{ $ticket->created_at->format('F d, Y') }}</div>
                        </div>
                        <div
                            class="event-status status-{{ $ticket->status === 'open' ? 'active' : ($ticket->status === 'in_progress' ? 'pending' : ($ticket->status === 'pending' ? 'pending-customer' : 'completed')) }}">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </div>
                    </div>
                    <div class="event-info">
                        <div class="event-attendees">
                            Assigned to: {{ $ticket->assignedTo ? $ticket->assignedTo->name : 'Unassigned' }}
                        </div>
                        <div class="event-price">
                            Priority: {{ ucfirst($ticket->priority) }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="event-card">
                    <div class="event-header">
                        <div>
                            <div class="event-title">No recent tickets</div>
                            <div class="event-date">-</div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="content-section">
        <div class="section-header">
            <div class="section-title">Recent Activity</div>
            <a href="{{ route('tickets.index') }}" class="btn btn-primary">View All</a>
        </div>
        <div class="activity-list">
            @forelse($recentActivities as $activity)
                <div class="activity-item">
                    <div class="activity-icon"><i class="{{ $activity['icon'] ?? 'fa-solid fa-info-circle' }}"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">{{ $activity['title'] }}</div>
                        <div class="activity-time">{{ $activity['time'] }}</div>
                    </div>
                </div>
            @empty
                <div class="activity-item">
                    <div class="activity-icon"><i class="fa-solid fa-info-circle"></i></div>
                    <div class="activity-content">
                        <div class="activity-title">No recent activity</div>
                        <div class="activity-time">-</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
