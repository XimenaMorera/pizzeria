<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderPizza;
use Illuminate\Http\Request;

class OrderPizzaController extends Controller
{
    // Listar todas las relaciones orden-pizza
    public function index()
    {
        return response()->json(OrderPizza::with(['order', 'pizza'])->get(), 200);
    }

    // Crear una nueva relación orden-pizza
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'pizza_id' => 'required|exists:pizzas,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderPizza = OrderPizza::create($request->all());
        return response()->json($orderPizza, 201);
    }

    // Mostrar una relación específica
    public function show($id)
    {
        $orderPizza = OrderPizza::with(['order', 'pizza'])->find($id);

        if (!$orderPizza) {
            return response()->json(['message' => 'Relación Orden-Pizza no encontrada'], 404);
        }

        return response()->json($orderPizza, 200);
    }

    // Actualizar una relación orden-pizza existente
    public function update(Request $request, $id)
    {
        $orderPizza = OrderPizza::find($id);

        if (!$orderPizza) {
            return response()->json(['message' => 'Relación Orden-Pizza no encontrada'], 404);
        }

        $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $orderPizza->update($request->all());
        return response()->json($orderPizza, 200);
    }

    // Eliminar una relación orden-pizza
    public function destroy($id)
    {
        $orderPizza = OrderPizza::find($id);

        if (!$orderPizza) {
            return response()->json(['message' => 'Relación Orden-Pizza no encontrada'], 404);
        }

        $orderPizza->delete();
        return response()->json(['message' => 'Relación Orden-Pizza eliminada'], 200);
    }
}
