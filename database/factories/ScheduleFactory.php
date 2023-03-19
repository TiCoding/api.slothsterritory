<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $schedule = $this->faker->unique()->randomElement(['6:00', '7:00', '8:00', '9:00', '13:00']);
        $capacity = $this->faker->randomElement([10, 20, 30]);
        $hoursBefore = 5;
        $tour = Tour::all()->random();

        return [
            'schedule' => $schedule,
            'capacity' => $capacity,
            'hours_before' => $hoursBefore,
            'tour_id' => $tour->id,
        ];
    }
}
