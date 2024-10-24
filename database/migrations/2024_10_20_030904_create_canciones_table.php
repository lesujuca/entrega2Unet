<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancionesTable extends Migration {
    public function up() {
        Schema::create('canciones', function (Blueprint $table) {
            $table->id() -> autoIncrement();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('canciones');
    }

}

