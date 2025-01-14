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
        Schema::create('montas', function (Blueprint $table) {
            $table->id();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();

            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('padre_id')->nullable();
            $table->foreign('madre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable();

            $table->string('descripcion')->nullable();
            $table->date('fecha_monta')->nullable();
            $table->time('tiempo_copula')->nullable();
            $table->boolean('gestante')->nullable();
            $table->date('fecha_paricion_estimada')->nullable();
            $table->integer('numero_monta_padre')->nullable();
            $table->integer('numero_monta_madre')->nullable();

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
        Schema::dropIfExists('montas');
    }
};
