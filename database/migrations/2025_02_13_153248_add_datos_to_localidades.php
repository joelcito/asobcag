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
        Schema::table('localidades', function (Blueprint $table) {
            $table->unsignedBigInteger('superior_id')->nullable()->after('usuario_eliminador_id');
            $table->foreign('superior_id')->references('id')->on('localidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidades', function (Blueprint $table) {
            //
        });
    }
};
