<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return response()->json($servicios);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'tipo' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'costo' => 'nullable|numeric',
        ]);

        $servicio = Servicio::create($data);
        return response()->json($servicio, 201);
    }

    public function show($id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        return response()->json($servicio);
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $data = $request->validate([
            'vehiculo_id' => 'sometimes|exists:vehiculos,id',
            'tipo' => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'sometimes|date',
            'costo' => 'nullable|numeric',
        ]);

        $servicio->update($data);
        return response()->json($servicio);
    }

    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        $servicio->delete();
        return response()->json(['message' => 'Servicio eliminado']);
    }
}
