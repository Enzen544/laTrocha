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
        Schema::create('combustible_registros', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->enum('tipo', ['gasolina', 'acpm']);
            $table->decimal('lectura_anterior', 12, 2);
            $table->decimal('lectura_actual', 12, 2);
            $table->decimal('diferencia', 12, 2);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total', 14, 2);
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
        Schema::dropIfExists('combustible_registros');
    }
};
