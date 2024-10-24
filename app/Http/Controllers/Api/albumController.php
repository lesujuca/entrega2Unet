<?php

namespace App\Http\Controllers\Api;

use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index() {
        try {
            $albums = Album::with('canciones')->get();
            if ($albums->isEmpty()) {
                return response()->json([
                    'message' => 'No hay albums',
                    'status' => 404
                ], 404);
            } else {
                return response()->json($albums, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function show($id)
    {

        if (!Album::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Album no encontrado',
                'status' => 404
            ], 404);
        }
        return Album::with('canciones')->findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $album = new Album($request->all());
            $album->save();
            return response()->json($album, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $album = new Album($request->all());
        $album->save();
        return response()->json($album, 201);
    }

    public function update(Request $request, $id)
    {
        if (!Album::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Album no encontrado',
                'status' => 404
            ], 404);
        }
        $album = Album::findOrFail($id);
        $album->update($request->all());
        return response()->json($album, 200);
    }

    public function delete($id)
    {
        if (!Album::where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Album no encontrado',
                'status' => 404
            ], 404);
        }
        Album::destroy($id);
        return response()->json([
            'message' => 'Album eliminado',
            'status' => 200
            ], 200);
    }
    
    
}