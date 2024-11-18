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
        Schema::table('fx_fcm_notification_attempts', function (Blueprint $table) {
            $table->foreignId('notification_id')->after('id')->constrained('fx_fcm_notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fx_fcm_notification_attempts', function (Blueprint $table) {
            //
        });
    }
};
