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
        Schema::create('criaderos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('propietario_id')->nullable();
            $table->foreign('propietario_id')->references('id')->on('users');
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->foreign('tecnico_id')->references('id')->on('users');
            $table->unsignedBigInteger('pastor_id')->nullable();
            $table->foreign('pastor_id')->references('id')->on('users');
            $table->unsignedBigInteger('localidad_id')->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');

            $table->string('nombre')->nullable();
            $table->string('nit')->nullable();
            $table->string('estancia')->nullable();
            $table->tinyInteger('negocio_fibra')->nullable();
            $table->tinyInteger('negocio_carne')->nullable();
            $table->tinyInteger('negocio_animal')->nullable();
            
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
        Schema::dropIfExists('criaderos');
    }
};
