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
        Schema::create('ejemplares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('raza_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->unsignedBigInteger('fenotipo_id')->nullable();
            $table->foreign('fenotipo_id')->references('id')->on('fenotipos');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colores');
            $table->unsignedBigInteger('criadero_id')->nullable();
            $table->foreign('criadero_id')->references('id')->on('criaderos');

            $table->string('nombre')->nullable();
            $table->string('sexo', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('numero_registro')->nullable();
            $table->string('microchip')->nullable();
            $table->string('arete')->nullable();
            $table->dateTime('fecha_registro')->nullable();
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
        Schema::dropIfExists('ejemplares');
    }
};
