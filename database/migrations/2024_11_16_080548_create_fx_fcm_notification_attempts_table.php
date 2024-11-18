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
        Schema::create('fx_fcm_notification_attempts', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0);
            $table->dateTime('planned')->nullable();
            $table->string('output')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fx_fcm_notification_attempts');
    }
};
