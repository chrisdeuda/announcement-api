<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'content' => $this->faker->sentence,
            'startDate' => $this->faker->date(pattern='%Y-%m-%d', end_datetime=None),
            'endDate' => $this->faker->date(pattern='%Y-%m-%d', end_datetime=None),
            'active' => true,
        ];
    }

}
