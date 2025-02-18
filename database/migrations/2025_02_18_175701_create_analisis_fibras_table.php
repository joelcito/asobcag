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
        Schema::create('analisis_fibras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('laboratorio_id')->nullable();
            $table->foreign('laboratorio_id')->references('id')->on('laboratorios');
            $table->unsignedBigInteger('equipo_id')->nullable();
            $table->foreign('equipo_id')->references('id')->on('equipos');

            $table->date('fecha_muestreo')->nullable();
            $table->date('fecha_analisis')->nullable();
            $table->string('zona_corporal')->nullable();
            $table->decimal('fd', 12, 2)->nullable();
            $table->decimal('sd', 12, 2)->nullable();
            $table->decimal('cv', 12, 2)->nullable();
            $table->decimal('fc', 12, 2)->nullable();
            $table->decimal('pm', 12, 2)->nullable();
            $table->decimal('mfd', 12, 2)->nullable();
            $table->string('laboratorio')->nullable();
            
            $table->string('estado')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_fibras');
    }
};
