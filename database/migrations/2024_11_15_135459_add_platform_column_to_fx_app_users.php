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
        Schema::table('fx_app_users', function (Blueprint $table) {
            $table->string('platform')->after('fcm_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fx_app_users', function (Blueprint $table) {
            $table->dropColumn('platform');
        });
    }
};
