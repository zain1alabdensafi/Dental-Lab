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
        Schema::create('teeth', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->OnDelete('cascade');
            $table->foreignId('treatment_id')->constrained('treatments')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->string('tooth_number');
            $table->unsignedInteger('bridge')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teeth');
    }
};
