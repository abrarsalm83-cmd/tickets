<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $clients = Client::withCount('tickets')->latest()->get();
            
            return response()->json([
                'data' => $clients->map(function ($client) {
                    return [
                        'id' => $client->id,
                        'name' => $client->name,
                        'email' => $client->email,
                        'tel' => $client->tel,
                        'tickets_count' => $client->tickets_count,
                        'created_at' => $client->created_at->format('M d, Y'),
                        'actions' => view('clients.partials.actions', compact('client'))->render()
                    ];
                })
            ]);
        }

        return view('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clients,email',
            'tel' => 'required|string|max:20'
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    public function show(Client $client)
    {
        $client->load('tickets');
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clients,email,' . $client->id,
            'tel' => 'required|string|max:20'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy(Client $client)
    {
        // Check if client has tickets
        if ($client->tickets()->count() > 0) {
            return redirect()->route('clients.index')->with('error', 'Cannot delete client with existing tickets. Please reassign or delete the tickets first.');
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}