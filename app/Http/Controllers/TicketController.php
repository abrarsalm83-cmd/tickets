<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['category', 'client', 'assignedTo'])
            ->latest()
            ->paginate(15);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        $clients = Client::all();
        $users = User::all();

        return view('tickets.create', compact('categories', 'clients', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'category_id' => 'required|exists:categories,id',
            'assigned_to' => 'nullable|exists:users,id',
            'subject_id'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'message'     => 'required|string',
            'description' => 'nullable|string',
            'priority'    => 'required|in:low,medium,high,urgent',
            'photos.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('assets/imgs'), $filename);
                $photos[] = $filename;
            }
        }

        Ticket::create([
            'user_id'     => auth()->id(),   // ✅ إضافة user_id
            'client_id'   => $request->client_id,
            'category_id' => $request->category_id,
            'assigned_to' => $request->assigned_to,
            'subject_id'  => $request->subject_id,
            'title'       => $request->title,
            'message'     => $request->message,
            'description' => $request->description,
            'status'      => 'open',
            'priority'    => $request->priority,
            'photos'      => $photos
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['category', 'client', 'assignedTo']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $clients = Client::all();
        $users = User::all();

        return view('tickets.edit', compact('ticket', 'categories', 'clients', 'users'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'category_id' => 'required|exists:categories,id',
            'assigned_to' => 'nullable|exists:users,id',
            'subject_id'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'message'     => 'required|string',
            'description' => 'nullable|string',
            'status'      => 'required|in:open,in_progress,pending,resolved,closed',
            'priority'    => 'required|in:low,medium,high,urgent',
            'photos.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photos = $ticket->photos ?? [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('assets/imgs'), $filename);
                $photos[] = $filename;
            }
        }

        $ticket->update([
            'user_id'     => auth()->id(),   // ✅ إضافة user_id هنا كمان
            'client_id'   => $request->client_id,
            'category_id' => $request->category_id,
            'assigned_to' => $request->assigned_to,
            'subject_id'  => $request->subject_id,
            'title'       => $request->title,
            'message'     => $request->message,
            'description' => $request->description,
            'status'      => $request->status,
            'priority'    => $request->priority,
            'photos'      => $photos
        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->photos) {
            foreach ($ticket->photos as $photo) {
                $photoPath = public_path('assets/imgs/' . $photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
        }

        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully!');
    }
}
