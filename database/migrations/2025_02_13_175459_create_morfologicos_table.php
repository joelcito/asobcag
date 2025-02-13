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
        Schema::create('morfologicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('evaluador_id')->nullable();
            $table->foreign('evaluador_id')->references('id')->on('users');

            $table->string('motivo')->nullable();
            $table->date('fecha_evaluacion')->nullable();
            $table->string('oreja')->nullable();
            $table->string('cuello')->nullable();
            $table->string('cabeza')->nullable();
            $table->string('alzada')->nullable();
            $table->string('largo_cuerpo')->nullable();
            $table->string('amplitud_pecho')->nullable();
            $table->string('fortaleza')->nullable();
            $table->string('balance')->nullable();
            $table->string('canias')->nullable();
            $table->string('copete')->nullable();
            $table->string('linea_superior')->nullable();
            $table->string('grupa')->nullable();
            
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
        Schema::dropIfExists('morfologicos');
    }
};
