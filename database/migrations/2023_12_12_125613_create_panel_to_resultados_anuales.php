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
        Schema::create('panel_to_resultados_anuales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('panel_id')->constrained('paneles');
            $table->foreignId('subpanel_res_anual_id')->constrained('subpaneles_resultado_anual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_to_resultados_anuales');
    }
};
