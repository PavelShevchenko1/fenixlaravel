<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdditionalAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan db:seed --class=AdditionalAdminsSeeder

        User::updateOrCreate([
            'email' => '<email>'
        ], [
            'name' => '<name>',
            'password' => Hash::make('<password>'),
            'created_at' => now(),
        ]);
        // User::updateOrCreate([
        //     'email' => '<email>'
        // ], [
        //     'name' => '<name>',
        //     'password' => Hash::make('<password>'),
        //     'created_at' => now(),
        // ]);
    }
}
