@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">🎫 Ticket #{{ $ticket->id }}</h1>
                <p class="text-gray-600 mt-2">{{ $ticket->title }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('tickets.edit', $ticket) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    ✏️ Edit Ticket
                </a>
                <a href="{{ route('tickets.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    ← Back to List
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ticket Details</h2>
                    
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Subject ID</h3>
                        <p class="text-gray-900">{{ $ticket->subject_id }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Message</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $ticket->message }}</p>
                        </div>
                    </div>

                    @if($ticket->description)
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Additional Description</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-900 whitespace-pre-wrap">{{ $ticket->description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($ticket->photos && count($ticket->photos) > 0)
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Attachments</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($ticket->photos as $photo)
                                    <div class="relative">
                                        <img src="{{ asset('assets/imgs/' . $photo) }}" alt="Ticket Photo" 
                                             class="w-full h-32 object-cover rounded-lg border cursor-pointer"
                                             onclick="openImageModal('{{ asset('assets/imgs/' . $photo) }}')">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all rounded-lg"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ticket Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Status</h3>
                            <span class="inline-block mt-1 px-3 py-1 text-sm font-medium rounded-full 
                                {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $ticket->status === 'pending' ? 'bg-orange-100 text-orange-800' : '' }}
                                {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $ticket->status === 'closed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Priority</h3>
                            <span class="inline-block mt-1 px-3 py-1 text-sm font-medium rounded-full 
                                {{ $ticket->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $ticket->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $ticket->priority === 'high' ? 'bg-orange-100 text-orange-800' : '' }}
                                {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Client</h3>
                            <p class="mt-1 text-gray-900">{{ $ticket->client->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Category</h3>
                            <p class="mt-1 text-gray-900">{{ $ticket->category->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Assigned To</h3>
                            <p class="mt-1 text-gray-900">{{ $ticket->assignedTo->name ?? 'Unassigned' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Created</h3>
                            <p class="mt-1 text-gray-900">{{ $ticket->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Last Updated</h3>
                            <p class="mt-1 text-gray-900">{{ $ticket->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    
                    <div class="space-y-3">
                        <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="inline-block w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">
                            <input type="hidden" name="category_id" value="{{ $ticket->category_id }}">
                            <input type="hidden" name="assigned_to" value="{{ $ticket->assigned_to }}">
                            <input type="hidden" name="subject_id" value="{{ $ticket->subject_id }}">
                            <input type="hidden" name="title" value="{{ $ticket->title }}">
                            <input type="hidden" name="message" value="{{ $ticket->message }}">
                            <input type="hidden" name="description" value="{{ $ticket->description }}">
                            <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                            
                            @if($ticket->status !== 'in_progress')
                                <input type="hidden" name="status" value="in_progress">
                                <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    Mark In Progress
                                </button>
                            @endif
                        </form>

                        @if($ticket->status !== 'resolved')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="inline-block w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">
                                <input type="hidden" name="category_id" value="{{ $ticket->category_id }}">
                                <input type="hidden" name="assigned_to" value="{{ $ticket->assigned_to }}">
                                <input type="hidden" name="subject_id" value="{{ $ticket->subject_id }}">
                                <input type="hidden" name="title" value="{{ $ticket->title }}">
                                <input type="hidden" name="message" value="{{ $ticket->message }}">
                                <input type="hidden" name="description" value="{{ $ticket->description }}">
                                <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                                <input type="hidden" name="status" value="resolved">
                                
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    Mark Resolved
                                </button>
                            </form>
                        @endif

                        @if($ticket->status !== 'closed')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="inline-block w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">
                                <input type="hidden" name="category_id" value="{{ $ticket->category_id }}">
                                <input type="hidden" name="assigned_to" value="{{ $ticket->assigned_to }}">
                                <input type="hidden" name="subject_id" value="{{ $ticket->subject_id }}">
                                <input type="hidden" name="title" value="{{ $ticket->title }}">
                                <input type="hidden" name="message" value="{{ $ticket->message }}">
                                <input type="hidden" name="description" value="{{ $ticket->description }}">
                                <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                                <input type="hidden" name="status" value="closed">
                                
                                <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    Close Ticket
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="Full size image" class="max-w-full max-h-full object-contain">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection