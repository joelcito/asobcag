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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_creador_id')->nullable()->after('id');
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('rol_id')->nullable()->after('usuario_eliminador_id');
            $table->foreign('rol_id')->references('id')->on('roles');

            $table->string('nombres')->nullable()->after('password');
            $table->string('ap_paterno')->nullable()->after('nombres');
            $table->string('ap_materno')->nullable()->after('ap_paterno');
            $table->string('numero_celular')->nullable()->after('ap_materno');
            $table->string('estado')->nullable()->after('numero_celular');

            $table->datetime('deleted_at')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['usuario_creador_id']);
            $table->dropColumn('usuario_creador_id');
            $table->dropForeign(['usuario_modificador_id']);
            $table->dropColumn('usuario_modificador_id');
            $table->dropForeign(['usuario_eliminador_id']);
            $table->dropColumn('usuario_eliminador_id');

            $table->dropColumn('nombres');
            $table->dropColumn('ap_paterno');
            $table->dropColumn('ap_materno');
            $table->dropColumn('numero_celular');
            $table->dropColumn('estado');

            $table->dropColumn('deleted_at');
        });
    }
};
