<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo_tarea', 255);
            $table->string('descripcion_tarea', 255);

            // Relaciones
            $table->unsignedBigInteger('id_ticket')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();

            // Timestamps personalizados
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            // Llaves foráneas
            $table->foreign('id_ticket')->references('id')->on('tickets')->onDelete('set null');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
