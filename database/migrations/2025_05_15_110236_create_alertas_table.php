<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('tipo_alerta', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_alerta');
            $table->enum('estado', ['pendiente', 'completada'])->default('pendiente');
            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alertas');
    }
}
