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
        Schema::create('esquilas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');

            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('esquilador_id')->nullable();
            $table->foreign('esquilador_id')->references('id')->on('users');

            $table->date('fecha')->nullable();
            $table->string('tipo_esquila')->nullable();
            $table->tinyInteger('inca_esquila')->nullable();
            $table->decimal('peso_manto', 12, 2)->nullable();
            $table->decimal('peso_cuello', 12, 2)->nullable();
            $table->decimal('peso_braga', 12, 2)->nullable();
            $table->decimal('peso_total', 12, 2)->nullable();
            $table->decimal('longitud', 12, 2)->nullable();
            $table->text('observacion')->nullable();
            
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
        Schema::dropIfExists('esquilas');
    }
};
