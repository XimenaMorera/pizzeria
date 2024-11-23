<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Listar todas las órdenes
    public function index()
    {
        $orders = Order::with(['client'])->get();
        return response()->json($orders, 200);
    }

    // Crear una nueva orden
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string|in:pendiente,en_preparacion,listo,entregado',
            'total_price' => 'required|numeric|min:0',
        ]);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    // Mostrar detalles de una orden específica
    public function show($id)
    {
        $order = Order::with(['client', 'pizzas'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        return response()->json($order, 200);
    }

    // Actualizar una orden existente
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        $request->validate([
            'status' => 'sometimes|string|in:pendiente,en_preparacion,listo,entregado',
            'total_price' => 'sometimes|numeric|min:0',
        ]);

        $order->update($request->all());
        return response()->json($order, 200);
    }

    // Eliminar una orden
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Orden eliminada'], 200);
    }
}
