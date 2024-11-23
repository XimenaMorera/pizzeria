<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Listar todas las sucursales
    public function index()
    {
        return response()->json(Branch::all(), 200);
    }

    // Crear una nueva sucursal
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $branch = Branch::create($request->all());
        return response()->json($branch, 201);
    }

    // Mostrar una sucursal específica
    public function show($id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        return response()->json($branch, 200);
    }

    // Actualizar una sucursal existente
    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
        ]);

        $branch->update($request->all());
        return response()->json($branch, 200);
    }

    // Eliminar una sucursal
    public function destroy($id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $branch->delete();
        return response()->json(['message' => 'Sucursal eliminada'], 200);
    }
}
