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
        Schema::create('fx_fcm_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->string('image')->nullable();
            $table->foreignId('news_id')->nullable()->constrained('fx_news')->onDelete('set null');
            $table->boolean('to_all')->default(false);
            $table->string('to_age')->nullable();
            $table->string('to_gender')->nullable();
            $table->string('to_platform')->nullable();
            $table->boolean('is_birthday')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fx_fcm_notifications');
    }
};
