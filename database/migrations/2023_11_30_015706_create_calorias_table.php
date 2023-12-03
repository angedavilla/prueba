// database/migrations/xxxx_xx_xx_create_calorias_consumidas_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaloriasTable extends Migration
{
    public function up()
    {
        Schema::create('calorias', function (Blueprint $table) {
            $table->id();
            $table->string('alimento');
            $table->integer('cantidad');
            $table->integer('calorias');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('persona_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calorias');
    }
}