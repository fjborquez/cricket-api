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
        Schema::create('panel_to_subpanel', function (Blueprint $table) {
            $table->foreignId('panel_id')->constrained('paneles')->cascadeOnDelete();
            $table->foreignId('subpanel_id')->constrained('subpaneles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panel_to_subpanel', function (Blueprint $table) {
            $table->dropIfExists('panel_to_subpanel');
        });
    }
};
