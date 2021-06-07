<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Faker\Factory;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutMiddleware;


abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations,  WithoutMiddleware;


    protected $faker;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     *
     */
    protected function setUp():void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->withoutMiddleware();
    }

}
