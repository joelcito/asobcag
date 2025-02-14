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
        Schema::table('ejemplares', function (Blueprint $table) {
            $table->unsignedBigInteger('padre_id')->nullable()->after('usuario_eliminador_id');
            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable()->after('padre_id');
            $table->foreign('madre_id')->references('id')->on('ejemplares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ejemplares', function (Blueprint $table) {
            $table->dropForeign(['padre_id']);
            $table->dropColumn('padre_id');
        });
    }
};
