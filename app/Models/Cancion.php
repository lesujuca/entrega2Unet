<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    protected $table = 'canciones';
    protected $fillable = ['nombre', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}


