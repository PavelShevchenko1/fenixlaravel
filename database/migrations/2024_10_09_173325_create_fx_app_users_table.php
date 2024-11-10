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
        Schema::create('fx_app_users', function (Blueprint $table) {
            $table->string('session_id')->unique()->nullable(false)->primary();
            $table->string('gender');
            $table->string('birth_date');
            $table->string('fcm_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fx_app_users');
    }
};
