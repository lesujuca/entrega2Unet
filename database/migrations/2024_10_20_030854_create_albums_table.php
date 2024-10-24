<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id() -> autoIncrement();
            $table->string('nombre');
            $table->string('artista');
            $table->string('generos');
            $table->string('premios')->nullable();
            $table->string('nominaciones')->nullable();
            $table->string('discografica');
            $table->integer('anio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
