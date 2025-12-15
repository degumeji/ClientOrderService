<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        return response()->json(Client::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable'
        ]);
        $client = Client::create($validated);
        return response()->json($client, 201);
    }

    public function update(Request $request, $id) {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy($id) {
        Client::destroy($id);
        return response()->json(['message' => 'Client deleted']);
    }
}
