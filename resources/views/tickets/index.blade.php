@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">🎫 Support Tickets</h1>
            <p class="text-gray-600 mt-2">Manage and track customer support requests</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
            ➕ Create New Ticket
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider min-w-48">Title</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-32">Client</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-28">Category</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-28">Status</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-24">Priority</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-28">Created</th>
                        <th class="px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-36">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-4 text-sm font-medium text-gray-900">
                                #{{ $ticket->id }}
                            </td>
                            <td class="px-3 py-4">
                                <div class="text-sm font-medium text-gray-900 leading-tight">{{ $ticket->title ?? $ticket->subject_id }}</div>
                                <div class="text-xs text-gray-500 mt-1 leading-tight">{{ Str::limit($ticket->message, 40) }}</div>
                            </td>
                            <td class="px-3 py-4">
                                <div class="text-sm text-gray-900 truncate">{{ $ticket->client->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-3 py-4">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full block w-fit">
                                    {{ $ticket->category->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-3 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full block w-fit
                                    {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->status === 'pending' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $ticket->status === 'closed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td class="px-3 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full block w-fit
                                    {{ $ticket->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $ticket->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->priority === 'high' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500">
                                {{ $ticket->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-3 py-4 text-sm font-medium">
                                <div class="flex flex-col space-y-1">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 text-xs">View</a>
                                    <a href="{{ route('tickets.edit', $ticket) }}" class="text-indigo-600 hover:text-indigo-900 text-xs">Edit</a>
                                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-xs" 
                                                onclick="return confirm('Are you sure you want to delete this ticket?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <div class="text-4xl mb-4">🎫</div>
                                    <p class="text-lg">No tickets found</p>
                                    <p class="text-sm">Create your first support ticket to get started</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($tickets->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection