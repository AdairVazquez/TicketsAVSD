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
            $table->id();
            $table->string('usuarioRem');
            $table->string('usuarioAsig');
            $table->string('titulo');
            $table->string('categoria');
            $table->string('sub_categoria');
            $table->string('prioridad');
            $table->string('descripcion');
            $table->unsignedBigInteger('tarea_id');
            $table->string('archivo');
            $table->timestamps();

            $table->foreign('tarea_id')->references('id')->on('tareas')->onUpdate('cascade')->onDelete('cascade');
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
