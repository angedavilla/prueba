<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('tipo_identificacion');
            $table->string('numero_identificacion');
            $table->string('genero');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('foto_cedula')->nullable();
            $table->string('foto_rostro')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
