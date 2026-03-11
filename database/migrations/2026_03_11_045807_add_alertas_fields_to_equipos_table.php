<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->boolean('alerta_activa')->default(false)->after('proximo_mantenimiento');
            $table->boolean('alerta_dias_antes')->default(true)->after('alerta_activa');
            $table->unsignedInteger('dias_anticipacion_alerta')->default(7)->after('alerta_dias_antes');
            $table->boolean('alerta_un_dia_antes')->default(true)->after('dias_anticipacion_alerta');
            $table->boolean('alerta_mismo_dia')->default(true)->after('alerta_un_dia_antes');
            $table->boolean('alerta_vencido')->default(true)->after('alerta_mismo_dia');
            $table->timestamp('ultima_alerta_enviada_at')->nullable()->after('alerta_vencido');
        });
    }

    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropColumn([
                'alerta_activa',
                'alerta_dias_antes',
                'dias_anticipacion_alerta',
                'alerta_un_dia_antes',
                'alerta_mismo_dia',
                'alerta_vencido',
                'ultima_alerta_enviada_at',
            ]);
        });
    }
};