<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    // Listar todos los ingredientes
    public function index()
    {
        return response()->json(Ingredient::all(), 200);
    }

    // Crear un nuevo ingrediente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name',
        ]);

        $ingredient = Ingredient::create($request->all());
        return response()->json($ingredient, 201);
    }

    // Mostrar un ingrediente específico
    public function show($id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }

        return response()->json($ingredient, 200);
    }

    // Actualizar un ingrediente existente
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }

        $request->validate([
            'name' => "sometimes|required|string|max:255|unique:ingredients,name,$id",
        ]);

        $ingredient->update($request->all());
        return response()->json($ingredient, 200);
    }

    // Eliminar un ingrediente
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }

        $ingredient->delete();
        return response()->json(['message' => 'Ingrediente eliminado'], 200);
    }
}
