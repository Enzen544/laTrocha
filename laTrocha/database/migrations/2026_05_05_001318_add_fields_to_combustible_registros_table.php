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
    Schema::table('combustible_registros', function (Blueprint $table) {
        $table->decimal('fiados_galones', 10, 2)->default(0)->after('diferencia');
        $table->decimal('galones_vendidos', 10, 2)->default(0)->after('fiados_galones');
        $table->decimal('efectivo_recaudado', 12, 2)->default(0)->after('total');
        $table->decimal('diferencia_pesos', 12, 2)->default(0)->after('efectivo_recaudado');
    });
}

public function down(): void
{
    Schema::table('combustible_registros', function (Blueprint $table) {
        $table->dropColumn(['fiados_galones', 'galones_vendidos', 'efectivo_recaudado', 'diferencia_pesos']);
    });
}
};
