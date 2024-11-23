<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
   // Listar todos los empleados
   public function index()
   {
       return response()->json(Employee::all(), 200);
   }

   // Crear un nuevo empleado
   public function store(Request $request)
   {
       $request->validate([
           'user_id' => 'required|exists:users,id',
           'position' => 'required|in:cajero,administrador,cocinero,mensajero',
           'identification_number' => 'required|string|max:20|unique:employees',
           'salary' => 'required|numeric|min:0',
           'hire_date' => 'required|date',
       ]);

       $employee = Employee::create($request->all());
       return response()->json($employee, 201);
   }

   // Mostrar detalles de un empleado
   public function show($id)
   {
       $employee = Employee::find($id);

       if (!$employee) {
           return response()->json(['message' => 'Empleado no encontrado'], 404);
       }

       return response()->json($employee, 200);
   }

   // Actualizar un empleado
   public function update(Request $request, $id)
   {
       $employee = Employee::find($id);

       if (!$employee) {
           return response()->json(['message' => 'Empleado no encontrado'], 404);
       }

       $request->validate([
           'position' => 'sometimes|in:cajero,administrador,cocinero,mensajero',
           'identification_number' => "sometimes|string|max:20|unique:employees,identification_number,$id",
           'salary' => 'sometimes|numeric|min:0',
           'hire_date' => 'sometimes|date',
       ]);

       $employee->update($request->all());
       return response()->json($employee, 200);
   }

   // Eliminar un empleado
   public function destroy($id)
   {
       $employee = Employee::find($id);

       if (!$employee) {
           return response()->json(['message' => 'Empleado no encontrado'], 404);
       }

       $employee->delete();
       return response()->json(['message' => 'Empleado eliminado'], 200);
   }
}