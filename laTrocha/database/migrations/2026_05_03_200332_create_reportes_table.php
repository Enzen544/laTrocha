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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['diario', 'semanal', 'mensual']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('total_gasolina', 14, 2)->default(0);
            $table->decimal('total_acpm', 14, 2)->default(0);
            $table->decimal('total_fiados', 14, 2)->default(0);
            $table->decimal('total_lavadas', 14, 2)->default(0);
            $table->decimal('total_bodega', 14, 2)->default(0);
            $table->decimal('gran_total', 14, 2)->default(0);
            $table->enum('estado', ['borrador', 'finalizado'])->default('borrador');
            $table->json('datos_extra')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
