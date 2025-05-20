<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->string('tipo'); // aceite, frenos, llantas, bateria, correa, enfriamiento
            $table->text('descripcion')->nullable();
            $table->integer('kilometraje');
            $table->date('fecha');
            $table->enum('estado', ['verde', 'amarillo', 'rojo'])->default('verde');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
