<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'artista', 'generos', 'premios', 'nominaciones', 'discografica', 'anio'];

    public function canciones()
    {
        return $this->hasMany(Cancion::class, 'album_id', 'id');
    }
}


