<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $dir = __DIR__ . '/../imo/';
        $path = $dir . 'ttt.txt';
        $this->withoutExceptionHandling();
        var_dump($dir);
        var_dump($path);
        mkdir($dir, 0777, true);
        file_put_contents($path ,'content', LOCK_EX | FILE_APPEND);
        // file_get_contents($path);
        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
