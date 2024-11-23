<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    // Listar todas las compras
    public function index()
    {
        return response()->json(Purchase::all(), 200);
    }

    // Crear una nueva compra
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date'
        ]);

        $purchase = Purchase::create($request->all());
        return response()->json($purchase, 201);
    }

    // Mostrar detalles de una compra específica
    public function show($id)
    {
        $purchase = Purchase::with(['supplier', 'rawMaterial'])->find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        return response()->json($purchase, 200);
    }

    // Actualizar una compra existente
    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $request->validate([
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'raw_material_id' => 'sometimes|required|exists:raw_materials,id',
            'quantity' => 'sometimes|required|numeric|min:0',
            'purchase_price' => 'sometimes|required|numeric|min:0',
            'purchase_date' => 'sometimes|required|date'
        ]);

        $purchase->update($request->all());
        return response()->json($purchase, 200);
    }

    // Eliminar una compra
    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $purchase->delete();
        return response()->json(['message' => 'Compra eliminada'], 200);
    }
}