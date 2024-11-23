<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        return response()->json(Pizza::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pizza = Pizza::create($request->all());
        return response()->json($pizza, 201);
    }

    public function show($id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Pizza no encontrada'], 404);
        }

        return response()->json($pizza, 200);
    }

    public function update(Request $request, $id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Pizza no encontrada'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pizza->update($request->all());
        return response()->json($pizza, 200);
    }

    public function destroy($id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Pizza no encontrada'], 404);
        }

        $pizza->delete();
        return response()->json(['message' => 'Pizza eliminada'], 200);
    }
}