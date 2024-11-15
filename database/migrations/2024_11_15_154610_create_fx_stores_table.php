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
        Schema::create('fx_stores', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('uptitle')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('hours')->nullable();
            $table->string('weekend_plan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fx_stores');
    }
};
