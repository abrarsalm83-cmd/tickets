@extends('layouts.app')

@section('content')
    <div class="content-section">
        <div class="section-header">
            <div class="section-title">Category Types</div>
            <button class="btn btn-primary" onclick="showCreateModal()">
                <span>➕</span>
                <span>Add Type</span>
            </button>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-container">
            <table id="categoryTypesTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type Name</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $categoryType)
                        <tr>
                            <td>{{ $categoryType->id }}</td>
                            <td>{{ $categoryType->name }}</td>
                            <td>{{ $categoryType->user->name ?? 'Unknown' }}</td>
                            <td>{{ $categoryType->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn-action edit" onclick="showEditModal({{ $categoryType->id }}, '{{ $categoryType->name }}')" title="Edit Type">
                                    ✏️
                                </button>
                                <button class="btn-action delete" onclick="showDeleteModal({{ $categoryType->id }}, '{{ $categoryType->name }}')" title="Delete Type">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal" id="createModal">
        <div class="modal-content">
            <div class="modal-title">
                🎫 Add New Type
            </div>
            <form action="{{ route('category-types.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Type Name</label>
                    <input type="text" class="form-input" name="name" placeholder="e.g., Concerts, Sports Events..." required>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-outline" onclick="closeCreateModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Type</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-title">
                ✏️ Edit Type
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Type Name</label>
                    <input type="text" class="form-input" id="editTypeName" name="name" required>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-outline" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Type</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-title">
                🗑️ Confirm Delete
            </div>
            <div class="delete-content">
                <p>Are you sure you want to delete "<span id="deleteTypeName"></span>"?</p>
                <p class="delete-warning">This action cannot be undone.</p>
            </div>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-buttons">
                    <button type="button" class="btn btn-outline" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .content-section {
            padding: 24px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border: 1px solid;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #16a34a;
            color: #15803d;
        }

        .alert-error {
            background-color: #fef2f2;
            border-color: #dc2626;
            color: #dc2626;
        }

        .alert ul {
            margin: 0;
            padding-left: 16px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }

        #categoryTypesTable {
            border-collapse: collapse;
        }

        #categoryTypesTable thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e5e7eb;
            color: #374151;
            font-weight: 600;
            padding: 12px 16px;
            text-align: left;
        }

        #categoryTypesTable tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }

        #categoryTypesTable tbody tr:hover {
            background-color: #f8fafc;
        }

        .btn-action {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 16px;
            padding: 6px 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
            margin: 0 2px;
        }

        .btn-action:hover {
            background: #f1f5f9;
            transform: scale(1.1);
        }

        .btn-action.edit:hover {
            color: #059669;
            background: #ecfdf5;
        }

        .btn-action.delete:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        .text-center {
            text-align: center;
            color: #6b7280;
            font-style: italic;
        }

        /* DataTable empty state styling */
        .dataTables_empty {
            text-align: center !important;
            color: #6b7280 !important;
            font-style: italic !important;
            padding: 40px 20px !important;
            background-color: #f9fafb !important;
            border: 2px dashed #d1d5db !important;
        }

        .dataTables_info {
            margin-top: 16px;
            color: #6b7280;
            font-size: 14px;
        }

        .dataTables_length {
            margin-bottom: 16px;
        }

        .dataTables_filter {
            margin-bottom: 16px;
        }

        .dataTables_paginate {
            margin-top: 16px;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-outline {
            background-color: transparent;
            color: #6b7280;
            border-color: #d1d5db;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            border-color: #b91c1c;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 24px;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            color: #1e293b;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .delete-content {
            margin: 20px 0;
        }

        .delete-content p {
            margin: 8px 0;
            color: #374151;
        }

        .delete-warning {
            color: #dc2626 !important;
            font-size: 0.875rem;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                padding: 24px;
            }

            .modal-buttons {
                flex-direction: column;
            }

            .section-header {
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }
        }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#categoryTypesTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50, 100],
                "order": [[0, "desc"]],
                "columnDefs": [
                    {
                        "targets": -1,
                        "orderable": false
                    }
                ],
                "language": {
                    "search": "Search types:",
                    "lengthMenu": "Show _MENU_ types per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ types",
                    "infoEmpty": "No types available",
                    "emptyTable": "No category types found. Click 'Add Type' to create your first category type.",
                    "zeroRecords": "No matching types found. Try adjusting your search criteria."
                },
                "autoWidth": false,
                "responsive": true,
                "processing": false,
                "serverSide": false,
                "deferRender": true
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);

            @if(isset($type))
                // Show edit modal if editing
                showEditModal({{ $type->id }}, '{{ $type->name }}');
            @endif
        });

        function showCreateModal() {
            document.getElementById('createModal').classList.add('show');
            document.querySelector('#createModal input[name="name"]').focus();
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.remove('show');
        }

        function showEditModal(id, name) {
            document.getElementById('editTypeName').value = name;
            document.getElementById('editForm').action = `/category-types/${id}`;
            document.getElementById('editModal').classList.add('show');
            document.getElementById('editTypeName').focus();
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        function showDeleteModal(id, name) {
            document.getElementById('deleteTypeName').textContent = name;
            document.getElementById('deleteForm').action = `/category-types/${id}`;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        // Close modals when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.classList.remove('show');
                });
            }
        });
    </script>
@endsection