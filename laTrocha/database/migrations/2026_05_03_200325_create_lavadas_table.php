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
        Schema::create('lavadas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->enum('tipo_vehiculo', ['auto', 'moto']);
            $table->enum('tipo_lavado', ['simple', 'completo'])->default('simple');
            $table->decimal('valor', 10, 2);
            $table->string('placa')->nullable();
            $table->enum('estado', ['pendiente', 'cancelado'])->default('pendiente');
            $table->date('fecha_pago')->nullable();
            $table->text('observacion')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavadas');
    }
};
