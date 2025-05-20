<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return response()->json($vehiculos);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio' => 'required|integer',
            'placa' => 'required|string|max:20|unique:vehiculos,placa',
            'color' => 'nullable|string|max:30',
            'tipo' => 'nullable|string|max:30',
        ]);

        $vehiculo = Vehiculo::create($data);
        return response()->json($vehiculo, 201);
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }
        return response()->json($vehiculo);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $data = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'marca' => 'sometimes|string|max:50',
            'modelo' => 'sometimes|string|max:50',
            'anio' => 'sometimes|integer',
            'placa' => 'sometimes|string|max:20|unique:vehiculos,placa,' . $id,
            'color' => 'sometimes|string|max:30',
            'tipo' => 'sometimes|string|max:30',
        ]);

        $vehiculo->update($data);

        return response()->json($vehiculo);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }
        $vehiculo->delete();
        return response()->json(['message' => 'Vehículo eliminado']);
    }
}
