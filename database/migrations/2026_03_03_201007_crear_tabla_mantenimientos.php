<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->text('descripcion_detallada'); // Qué se le hizo
            $table->text('refacciones_cambiadas')->nullable();
            $table->decimal('costo_mano_obra', 10, 2)->default(0);
            $table->decimal('costo_refacciones', 10, 2)->default(0);
            $table->string('tecnico_responsable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
