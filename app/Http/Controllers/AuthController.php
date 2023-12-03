<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'numero_identificacion' => 'required|string',
            'password' => 'required|string',
        ]);

        $persona = Persona::where('numero_identificacion', $request->numero_identificacion)->first();

        if (!$persona) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user = $persona->user;

        // Check if the user's password is correct
        if (!$user || !$this->checkCredentials($user, $request->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        // Generate an access token using Passport
        $token = DB::transaction(function () use ($user, $persona) {
            return [
                'token' => $user->createToken('MyApp')->accessToken,
                'user_id' => $user->id,
                'persona_id' => $persona->id,
            ];
        });
        return response()->json(['token' => $token], 200);
    }

    private function checkCredentials($user, $password)
    {
        return password_verify($password, $user->password);
    }
}
