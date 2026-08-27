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
        Schema::create('ejemplar_pre_registros', function (Blueprint $table) {
            $table->id();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();

            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('ejemplar_id')->nullable();

            $table->foreign('fenotipo_id')->references('id')->on('fenotipos');
            $table->unsignedBigInteger('fenotipo_id')->nullable();

            $table->foreign('color_id')->references('id')->on('colores');
            $table->unsignedBigInteger('color_id')->nullable();

            $table->foreign('criadero_id')->references('id')->on('criaderos');
            $table->unsignedBigInteger('criadero_id')->nullable();

            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('padre_id')->nullable();

            $table->foreign('madre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable();

            $table->string('tipo')->nullable();
            $table->string('numero_registro')->nullable();
            $table->string('microchip')->nullable();
            $table->string('nombre')->nullable();
            $table->string('arete')->nullable();
            $table->string('sexo')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('tipo_parto')->nullable();
            $table->text('texto_reconocido')->nullable();

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
        Schema::dropIfExists('ejemplar_pre_registros');
    }
};
