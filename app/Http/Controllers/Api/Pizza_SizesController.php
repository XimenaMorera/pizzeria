<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class PizzaSizesController extends Controller
{
    // Listar todos los tamaños de pizza
    public function index()
    {
        return response()->json(PizzaSize::all(), 200);
    }

    // Crear un nuevo tamaño de pizza
    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize = PizzaSize::create($request->all());
        return response()->json($pizzaSize, 201);
    }

    // Mostrar detalles de un tamaño específico
    public function show($id)
    {
        $pizzaSize = PizzaSize::with('pizza')->find($id);

        if (!$pizzaSize) {
            return response()->json(['message' => 'Tamaño de pizza no encontrado'], 404);
        }

        return response()->json($pizzaSize, 200);
    }

    // Actualizar un tamaño existente
    public function update(Request $request, $id)
    {
        $pizzaSize = PizzaSize::find($id);

        if (!$pizzaSize) {
            return response()->json(['message' => 'Tamaño de pizza no encontrado'], 404);
        }

        $request->validate([
            'size' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $pizzaSize->update($request->all());
        return response()->json($pizzaSize, 200);
    }

    // Eliminar un tamaño de pizza
    public function destroy($id)
    {
        $pizzaSize = PizzaSize::find($id);

        if (!$pizzaSize) {
            return response()->json(['message' => 'Tamaño de pizza no encontrado'], 404);
        }

        $pizzaSize->delete();
        return response()->json(['message' => 'Tamaño de pizza eliminado'], 200);
    }
}
