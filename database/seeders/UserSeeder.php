<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@themesbrand.com')->delete();
        DB::table('users')->where('email', 'fenix@fenix.ru')->delete();
        User::updateOrCreate([
            'email' => 'info@fenixbeer.ru'
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('fenix@!$#^%2024SMTXT'),
            'created_at' => now(),
        ]);
    }
}
