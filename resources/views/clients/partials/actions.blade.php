<div class="flex space-x-2">
    <a href="{{ route('clients.show', $client) }}" 
       class="text-blue-600 hover:text-blue-900 text-sm font-medium"
       title="View Details">
        👁️ View
    </a>
    <a href="{{ route('clients.edit', $client) }}" 
       class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
       title="Edit Client">
        ✏️ Edit
    </a>
    <button onclick="confirmDelete({{ $client->id }}, '{{ addslashes($client->name) }}')" 
            class="text-red-600 hover:text-red-900 text-sm font-medium"
            title="Delete Client">
        🗑️ Delete
    </button>
    <form id="delete-form-{{ $client->id }}" action="{{ route('clients.destroy', $client) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>