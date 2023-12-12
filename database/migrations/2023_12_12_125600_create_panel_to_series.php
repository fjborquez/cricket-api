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
        Schema::create('panel_to_series', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('panel_id')->constrained('paneles');
            $table->foreignId('serie_id')->constrained('series');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_to_series');
    }
};
