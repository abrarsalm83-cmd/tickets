@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">👥 Clients Management</h1>
            <p class="text-gray-600 mt-2">Manage client information and view their tickets</p>
        </div>
        <a href="{{ route('clients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
            ➕ Add New Client
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-6">
            <table id="clientsTable" class="w-full display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Tickets</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable - only AJAX for loading data
    $('#clientsTable').DataTable({
        ajax: {
            url: '{{ route("clients.index") }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'tel', name: 'tel' },
            { data: 'tickets_count', name: 'tickets_count', searchable: false },
            { data: 'created_at', name: 'created_at', searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        responsive: true,
        processing: true,
        serverSide: false,
        order: [[0, 'desc']],
        language: {
            emptyTable: "No clients found",
            zeroRecords: "No clients match your search"
        }
    });
});

// Confirm delete function
function confirmDelete(id, name) {
    if (confirm(`Are you sure you want to delete client "${name}"? This action cannot be undone.`)) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush