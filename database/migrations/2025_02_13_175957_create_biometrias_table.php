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
        Schema::create('biometrias', function (Blueprint $table) {
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
            $table->date('fecha')->nullable();
            $table->decimal('peso', 12, 2)->nullable();
            $table->decimal('altura_cruz', 12, 2)->nullable();
            $table->decimal('altura_grupa', 12, 2)->nullable();
            $table->decimal('altura_cabeza', 12, 2)->nullable();
            $table->decimal('ancho_pecho', 12, 2)->nullable();
            $table->decimal('ancho_isquiones', 12, 2)->nullable();
            $table->decimal('perimetro_toraxico', 12, 2)->nullable();
            $table->decimal('perimetro_abdominal', 12, 2)->nullable();
            $table->decimal('largo_cuello', 12, 2)->nullable();
            $table->decimal('cuello_perimetro_sup', 12, 2)->nullable();
            $table->decimal('cuello_perimetro_inf', 12, 2)->nullable();
            $table->decimal('largo_oreja', 12, 2)->nullable();
            $table->decimal('largo_cola', 12, 2)->nullable();
            $table->decimal('largo_cuerpo', 12, 2)->nullable();
            $table->decimal('diametro_cania_ant', 12, 2)->nullable();
            $table->decimal('diametro_cania_post', 12, 2)->nullable();
            
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
        Schema::dropIfExists('biometrias');
    }
};
