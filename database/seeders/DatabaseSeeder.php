<?php

namespace Database\Seeders;

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
        // call seeder
        $this->call([
            // DummyUsersSeeder::class,
            DummyTagsSeeder::class,
            ArticleStatusSeeder::class,
            UploadImageSeeder::class,
        ]);

        \App\Models\User::factory(20)->vulnerablePass()->create();
        \App\Models\Article::factory(200)->create();
    }
}
