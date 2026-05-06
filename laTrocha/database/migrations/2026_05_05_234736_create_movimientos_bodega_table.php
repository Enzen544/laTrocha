<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('movimientos_bodega')) {
            Schema::create('movimientos_bodega', function (Blueprint $table) {
                $table->id();
                $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
                $table->enum('tipo', ['entrada', 'salida']);
                $table->integer('cantidad');
                $table->string('descripcion')->nullable();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_bodega');
    }
};