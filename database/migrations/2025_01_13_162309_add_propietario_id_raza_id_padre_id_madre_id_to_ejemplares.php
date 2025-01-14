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
            $table->unsignedBigInteger('padre_id')->nullable()->after('raza_id');
            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable()->after('padre_id');
            $table->foreign('madre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('comunidad_id')->nullable()->after('madre_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidades');
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
            $table->dropForeign(['madre_id']);
            $table->dropColumn('madre_id');
            $table->dropForeign(['comunidad_id']);
            $table->dropColumn('comunidad_id');
        });
    }
};
