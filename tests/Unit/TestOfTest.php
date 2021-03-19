<?php


namespace Tests\Unit;

use Tests\TestCase;

class TestOfTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */

    public function setUp(): void
    {
        parent::setUp();
        dd(env('APP_ENV'), env('DB_HOST'));
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
