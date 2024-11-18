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
        Schema::create('fx_app_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('age_from')->default(0);
            $table->integer('age_to')->default(0);
            $table->string('barcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fx_app_user_groups');
    }
};
