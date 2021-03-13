<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Time;

class UploadImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('upload_images');
        $table->truncate();

        $images = [
            ['public/images/', 'dummy.jpg', 'dummy'],
        ];
        $now = Time::now();

        foreach ($images as $line) {
            $table->insert([
                'path' => $line[0] . $line[1],
                'name' => $line[1],
                'user_id' => random_int(1,9),
                'description' => $line[2],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        };

        for ($counter=1; $counter < 47; $counter++) {
            $num = sprintf('%03d', $counter);
            $table->insert([
                'path' => 'public/images/' . 'default-' . $num . '.jpg',
                'name' => 'default-' . $num . '.jpg',
                'user_id' => random_int(1,9),
                'description' => 'image' . $num,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
