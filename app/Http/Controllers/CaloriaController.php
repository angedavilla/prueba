<?php

namespace App\Http\Controllers;

use App\Models\Calorias;
use Illuminate\Http\Request;

class CaloriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'alimento' => 'required|string',
            'cantidad' => 'required|integer',
            'calorias' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'user_id' => 'required|exists:users,id',
            'persona_id' => 'required|exists:personas,id',
        ]);

        $caloria = Calorias::create($request->all());

        return response()->json(['message' => 'Caloría registrada con éxito', 'caloria' => $caloria], 201);
    }

    public function historico(Request $request, $personaId)
    {
        // Validar la solicitud
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Obtener las calorías en el rango de fecha para la persona específica
        $historico = Calorias::where('persona_id', $personaId)
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->get();

        // Devolver una respuesta JSON con el histórico
        return response()->json(['historico' => $historico]);
    }

    public function historicoUsuario(Request $request, $personaId)
{
    // Obtener todas las calorías para la persona específica
    $historico = Calorias::where('persona_id', $personaId)->get();

    // Devolver una respuesta JSON con el histórico
    return response()->json(['historico' => $historico]);
}
}