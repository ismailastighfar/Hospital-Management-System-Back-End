<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1,['role' => '0'])->create();
        \App\Models\Doctor::factory(5)->create();
        \App\Models\Patient::factory(20)->create();
    }
}
