<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'tipo_identificacion' => 'required|string',
            'numero_identificacion' => 'required|string|unique:personas',
            'genero' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'foto_cedula' => 'string',
            'foto_rostro' => 'string',
        ]);

        // Crear persona
        $persona = new Persona([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'tipo_identificacion' => $request->input('tipo_identificacion'),
            'numero_identificacion' => $request->input('numero_identificacion'),
            'genero' => $request->input('genero'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
        ]);

        // Subir imágenes si se proporcionaron
        if ($request->hasFile('foto_cedula')) {
            // Código para manejar la imagen de la cédula
        }

        if ($request->hasFile('foto_rostro')) {
            // Código para manejar la imagen del rostro
        }

        $persona->save();

        // Crear usuario
        $user = new User([
            'name' => $persona->nombre,
            'password' => bcrypt($persona->numero_identificacion),
            'persona_id' => $persona->id,
        ]);

        $user->save();

        // Asociar la persona al usuario
        $persona->user()->associate($user);
        $persona->save();

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Persona y cuenta de usuario creadas exitosamente.'], 201);
    }

    public function get($id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        return response()->json($persona, 200);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'tipo_identificacion' => 'required|string',
            'numero_identificacion' => 'required|string|unique:personas,numero_identificacion,' . $id,
            'genero' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'foto_cedula' => 'string',
            'foto_rostro' => 'string',
        ]);

        // Buscar la persona por ID
        $persona = Persona::findOrFail($id);

        // Actualizar los campos de la persona
        $persona->update([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'tipo_identificacion' => $request->input('tipo_identificacion'),
            'numero_identificacion' => $request->input('numero_identificacion'),
            'genero' => $request->input('genero'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
        ]);

        // Subir imágenes si se proporcionaron
        if ($request->hasFile('foto_cedula')) {
            // Código para manejar la imagen de la cédula
        }

        if ($request->hasFile('foto_rostro')) {
            // Código para manejar la imagen del rostro
        }

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Información de la persona actualizada exitosamente.']);
    }
}
