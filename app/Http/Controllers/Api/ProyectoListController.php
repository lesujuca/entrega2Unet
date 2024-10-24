<?php

namespace App\Http\Controllers\Api;

use App\Models\Proyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoListController extends Controller
{
    public function index() {
        try {
            $proyectos = Proyecto::all(); // Obtener todos los proyectos
    
            if ($proyectos->isEmpty()) {
                return response()->json([
                    'message' => 'No hay proyectos registrados',
                ], 404);
            } else {
                return response()->json($proyectos);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los proyectos',
            ], 500);
        }
    }
}
