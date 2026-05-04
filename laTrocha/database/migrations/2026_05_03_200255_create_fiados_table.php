<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entidad_id')->constrained('entidades')->onDelete('restrict');
            $table->enum('tipo', ['fiado', 'abono']);
            $table->enum('tipo_registro', ['pesos', 'galones'])->default('pesos');
            $table->decimal('monto', 12, 2);
            $table->decimal('galones', 8, 3)->nullable();
            $table->string('descripcion')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiados');
    }
};