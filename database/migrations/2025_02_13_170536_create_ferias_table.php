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
        Schema::create('ferias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('localidad_id')->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->unsignedBigInteger('categoria_feria_id')->nullable();
            $table->foreign('categoria_feria_id')->references('id')->on('categoria_ferias');
            $table->unsignedBigInteger('premio_id')->nullable();
            $table->foreign('premio_id')->references('id')->on('premios');
            $table->unsignedBigInteger('juez_principal_id')->nullable();
            $table->foreign('juez_principal_id')->references('id')->on('users');
            $table->unsignedBigInteger('juez_adjunto_id')->nullable();
            $table->foreign('juez_adjunto_id')->references('id')->on('users');

            $table->string('nombre')->nullable();
            $table->date('fecha')->nullable();
            $table->tinyInteger('nacional')->nullable();
            $table->tinyInteger('departamental')->nullable();
            $table->tinyInteger('municipal')->nullable();
            $table->string('tipo')->nullable();

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
        Schema::dropIfExists('ferias');
    }
};
