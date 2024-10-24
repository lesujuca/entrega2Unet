<?php
// Este controlador maneja la autenticación de usuarios en la aplicación. 
// Incluye métodos para el registro y el inicio de sesión. 
// El registro valida los datos del usuario, crea un nuevo usuario y genera un token JWT. 
// El inicio de sesión valida las credenciales del usuario y devuelve un token JWT si son correctas.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:6|confirmed',
    ]);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Something went wrong, please try again.'
        ], 500);
    }
}

public function login(Request $request)
{
    // Aplicamos la validación manualmente
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    try {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Credenciales Invalidas.'
            ], 401);
        }
        return response()->json([
            'user' => JWTAuth::user(),
            'token' => $token
        ], 200);
    } catch (JWTException $e) {
        return response()->json([
            'error' => 'Error inesperado. Por favor, intente nuevamente.'
        ], 500);
    }
}

public function logout(Request $request)
{
    try {
        // Invalida el token actual
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Sesión cerrada correctamente.'], 200);
    } catch (JWTException $e) {
        return response()->json(['error' => 'No se pudo cerrar la sesión, por favor intente nuevamente.'], 500);
    }
}
}