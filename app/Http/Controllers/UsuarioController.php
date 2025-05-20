<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Ver un usuario específico
    public function show($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    // Actualizar datos del usuario
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $usuario->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errores' => $validator->errors()], 422);
        }

        $usuario->update($request->only(['name', 'email']));

        return response()->json(['mensaje' => 'Usuario actualizado correctamente'], 200);
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario eliminado correctamente'], 200);
    }

    // Cambiar contraseña
    public function cambiarContrasena(Request $request, $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'password_actual' => 'required|string',
            'password_nueva' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errores' => $validator->errors()], 422);
        }

        if (!Hash::check($request->password_actual, $usuario->password)) {
            return response()->json(['mensaje' => 'La contraseña actual no es correcta'], 403);
        }

        $usuario->password = Hash::make($request->password_nueva);
        $usuario->save();

        return response()->json(['mensaje' => 'Contraseña actualizada correctamente'], 200);
    }
}
