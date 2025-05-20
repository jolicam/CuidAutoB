<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function index()
    {
        $alertas = Alerta::all();
        return response()->json($alertas);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'mensaje' => 'required|string|max:255',
            'fecha_alerta' => 'required|date',
        ]);

        $alerta = Alerta::create($data);
        return response()->json($alerta, 201);
    }

    public function show($id)
    {
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json(['message' => 'Alerta no encontrada'], 404);
        }
        return response()->json($alerta);
    }

    public function update(Request $request, $id)
    {
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json(['message' => 'Alerta no encontrada'], 404);
        }

        $data = $request->validate([
            'vehiculo_id' => 'sometimes|exists:vehiculos,id',
            'mensaje' => 'sometimes|string|max:255',
            'fecha_alerta' => 'sometimes|date',
        ]);

        $alerta->update($data);
        return response()->json($alerta);
    }

    public function destroy($id)
    {
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json(['message' => 'Alerta no encontrada'], 404);
        }
        $alerta->delete();
        return response()->json(['message' => 'Alerta eliminada']);
    }
}

