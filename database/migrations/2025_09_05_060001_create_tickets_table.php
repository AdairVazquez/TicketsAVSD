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
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();

            // Relaciones con usuarios
            $table->unsignedBigInteger('id_usuario_creador')->nullable();
            $table->unsignedBigInteger('id_usuario_asignado')->nullable();

            // Relaciones con otras tablas
            $table->unsignedBigInteger('id_subcategoria')->nullable();
            $table->unsignedBigInteger('id_prioridad')->nullable();
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->unsignedBigInteger('id_archivo')->nullable();
            $table->unsignedBigInteger('id_archivo_respuesta')->nullable();

            // Timestamps personalizados
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            // Llaves foráneas
            $table->foreign('id_usuario_creador')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_usuario_asignado')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_subcategoria')->references('id')->on('subcategoria')->onDelete('set null');
            $table->foreign('id_prioridad')->references('id')->on('prioridades')->onDelete('set null');
            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('set null');
            $table->foreign('id_archivo')->references('id')->on('archivos')->onDelete('set null');
            $table->foreign('id_archivo_respuesta')->references('id')->on('archivos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
