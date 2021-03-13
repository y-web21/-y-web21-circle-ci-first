<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::factory(1)->testUser()->create();
        User::factory(1)->vulnerablePass()->testEmail()->create();
        User::factory(5)->vulnerablePass()->create(['password' => Hash::make('password')]);
    }
}
