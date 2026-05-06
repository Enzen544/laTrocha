<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio_compra', 10, 2)->default(0)->after('categoria');
            $table->decimal('precio_venta', 10, 2)->default(0)->after('precio_compra');
            $table->integer('stock_minimo')->default(5)->after('stock_actual');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['precio_compra', 'precio_venta', 'stock_minimo']);
        });
    }
};