<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('tags');
        $table->truncate();
        $tags = ['戯言','無価値','風説の流布'];
        foreach ($tags as $tag) {
            $table->insert(['name' => $tag]);
        }
    }
}
