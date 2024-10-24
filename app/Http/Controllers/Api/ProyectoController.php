<?php

namespace App\Http\Controllers\Api;

use App\Models\Proyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoController extends Controller
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
    

    public function show($id)
    {

        if (!Proyecto::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ], 404);
        }
        return Proyecto::all()->findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $proyecto = new Proyecto($request->all());
            $proyecto->save();
            return response()->json($proyecto, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $proyecto = new Proyecto($request->all());
        $proyecto->save();
        return response()->json($proyecto, 201);
    }

    public function update(Request $request, $id)
    {
        if (!Proyecto::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ], 404);
        }
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->all());
        return response()->json($proyecto, 200);
    }

    public function delete($id)
    {
        if (!Proyecto::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ], 404);
        }
        Proyecto::destroy($id);
        return response()->json([
            'message' => 'Proyecto eliminado',
            'status' => 200
            ], 200);
    }
}
