<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        // Filtros básicos [cite: 25]
        $query = Order::with('client');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        return response()->json($query->get());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'orderDate' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'in:Pending,Completed,Cancelled'
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    // Método para estadísticas del Dashboard [cite: 29]
    public function stats() {
        return response()->json([
            'total_orders' => Order::count(),
            'completed_orders' => Order::where('status', 'Completed')->count(),
            'pending_orders' => Order::where('status', 'Pending')->count(),
            'active_clients' => \App\Models\Client::has('orders')->count() // Clientes con al menos 1 pedido
        ]);
    }
}
