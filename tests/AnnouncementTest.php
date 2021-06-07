<?php

class AnnouncementTest extends TestCase
{

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_announcement()
    {
        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'startDate' => '12/1/2021',
            'endDate' => '12/1/2021',
            'active' => 1,
        ];



        $this->post(route('announcement_create'), $data);
        $this->seeStatusCode(201);

    }


}
