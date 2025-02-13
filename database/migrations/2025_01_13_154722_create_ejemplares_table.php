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
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();


            $table->foreign('propietario_id')->references('id')->on('users');
            $table->unsignedBigInteger('propietario_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->unsignedBigInteger('raza_id')->nullable();

            $table->integer('numero_registro')->nullable();
            $table->string('nombre')->nullable();
            $table->string('color')->nullable();
            $table->string('sexo', 10)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('codigo_origen')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('color_tradicional')->nullable();
            $table->string('numero_arete')->nullable();
            $table->decimal('peso_nacimiento', 5,2)->nullable();
            $table->decimal('peso_vivo', 5,2)->nullable();
            $table->decimal('perimetro_toracico', 5,2)->nullable();
            $table->decimal('altura_cruz', 5,2)->nullable();
            $table->decimal('altura_grupa', 5,2)->nullable();
            $table->decimal('largo_cuerpo', 5,2)->nullable();
            $table->decimal('ancho_anca', 5,2)->nullable();
            $table->decimal('largo_cuello', 5,2)->nullable();

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
