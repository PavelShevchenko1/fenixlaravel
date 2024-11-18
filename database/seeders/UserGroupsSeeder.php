<?php

namespace Database\Seeders;

use App\Models\FxAppUserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FxAppUserGroup::create([
            'title' => 'Группа 1',
            'age_from' => 18,
            'age_to' => 25,
            'barcode' => '2110000000110',
        ]);
        FxAppUserGroup::create([
            'title' => 'Группа 2',
            'age_from' => 26,
            'age_to' => 40,
            'barcode' => '2110000000219',
        ]);
        FxAppUserGroup::create([
            'title' => 'Группа 3',
            'age_from' => 41,
            'age_to' => 60,
            'barcode' => '2110000000318',
        ]);
        FxAppUserGroup::create([
            'title' => 'Группа 4',
            'age_from' => 60,
            'age_to' => 120,
            'barcode' => '2110000000417',
        ]);
    }
}
