<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cancion;
use App\Models\Album;

class cancionController extends Controller
{
    public function getCanciones($albumId)
    {
        $album = Album::findOrFail($albumId);
        return $album->canciones; 
    }

    public function addCancion(Request $request, $albumId) {
        $request->validate(['nombre' => 'required|string']);
        
        try {
            $cancion = new Cancion($request->all());
            $cancion->album_id = $albumId;
            $cancion->save();
            
            return response()->json($cancion, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateCancion(Request $request, $albumId, $cancionId) {
        $request->validate(['nombre' => 'required|string']);
        
        try {
            $cancion = Cancion::where('album_id', $albumId)->where('id', $cancionId)->firstOrFail();
            $cancion->update($request->all());
            
            return response()->json($cancion, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteCancion($albumId, $cancionId) {
        try {
            $cancion = Cancion::where('album_id', $albumId)->where('id', $cancionId)->firstOrFail();
            $cancion->delete();
            
            return response()->json(['message' => 'Canción eliminada'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
