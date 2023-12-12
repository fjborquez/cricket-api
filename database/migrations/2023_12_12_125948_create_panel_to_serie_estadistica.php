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
        Schema::create('panel_to_serie_estadistica', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('panel_id')->constrained('paneles');
            $table->foreignId('subpaneles_ser_est_id')->constrained('subpaneles_serie_estadistica');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_to_serie_estadistica');
    }
};
