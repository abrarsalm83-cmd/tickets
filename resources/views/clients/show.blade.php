@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">👥 Client Details</h1>
                <p class="text-gray-600 mt-2">{{ $client->name }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('clients.edit', $client) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    ✏️ Edit Client
                </a>
                <a href="{{ route('clients.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    ← Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Client Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Client Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Name</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $client->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Email</label>
                            <p class="text-gray-900">
                                <a href="mailto:{{ $client->email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $client->email }}
                                </a>
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Phone</label>
                            <p class="text-gray-900">
                                <a href="tel:{{ $client->tel }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $client->tel }}
                                </a>
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Member Since</label>
                            <p class="text-gray-900">{{ $client->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tickets List -->
                @if($client->tickets->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Tickets</h2>
                        
                        <div class="space-y-4">
                            @foreach($client->tickets->take(5) as $ticket)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="font-medium text-gray-900">
                                                <a href="{{ route('tickets.show', $ticket) }}" class="hover:text-blue-600">
                                                    #{{ $ticket->id }} - {{ $ticket->title ?? $ticket->subject_id }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ticket->message, 100) }}</p>
                                            <div class="flex items-center mt-2 space-x-4">
                                                <span class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</span>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                    {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $ticket->status === 'pending' ? 'bg-orange-100 text-orange-800' : '' }}
                                                    {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $ticket->status === 'closed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full ml-4
                                            {{ $ticket->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $ticket->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $ticket->priority === 'high' ? 'bg-orange-100 text-orange-800' : '' }}
                                            {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($client->tickets->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('tickets.index', ['client' => $client->id]) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    View all {{ $client->tickets->count() }} tickets →
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Statistics</h2>
                    
                    <div class="space-y-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $client->tickets->count() }}</div>
                            <div class="text-sm text-gray-600">Total Tickets</div>
                        </div>
                        
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600">
                                {{ $client->tickets->whereIn('status', ['open', 'in_progress', 'pending'])->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Open Tickets</div>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">
                                {{ $client->tickets->whereIn('status', ['resolved', 'closed'])->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Resolved Tickets</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    
                    <div class="space-y-3">
                        <a href="{{ route('tickets.create', ['client_id' => $client->id]) }}" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                            ➕ Create New Ticket
                        </a>
                        
                        <a href="mailto:{{ $client->email }}" 
                           class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                            📧 Send Email
                        </a>
                        
                        <a href="tel:{{ $client->tel }}" 
                           class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                            📞 Call Client
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection