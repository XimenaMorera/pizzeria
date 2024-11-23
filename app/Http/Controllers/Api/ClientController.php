<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Listar todos los clientes
    public function index()
    {
        return response()->json(Client::all(), 200);
    }

    // Crear un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    // Mostrar detalles de un cliente específico
    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($client, 200);
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:clients,email,$id",
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:255',
        ]);

        $client->update($request->all());
        return response()->json($client, 200);
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client->delete();
        return response()->json(['message' => 'Cliente eliminado'], 200);
    }
}
