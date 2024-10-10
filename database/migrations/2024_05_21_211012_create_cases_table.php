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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('patient_name');
            $table->unsignedInteger('age');
            $table->enum('gender', ['male','female']);
            $table->boolean('need_trial');
            $table->boolean('repeate');
            $table->text('notes');
            $table->string('shade');
            $table->date('expect_delivery_time');
            $table->unsignedInteger('rate')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('confirm_delivery')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
