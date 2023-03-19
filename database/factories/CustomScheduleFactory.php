<?php

namespace Database\Factories;

use App\Models\CustomDate;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $schedule = $this->faker->unique()->randomElement(['7:30', '8:30', '9:30', '10:30']);
        $capacity = $this->faker->randomElement([10, 20, 30]);
        $hoursBefore = 5;
        $tour = Tour::all()->random();
        $customDate = CustomDate::all()->random();

        return [
            'schedule' => $schedule,
            'capacity' => $capacity,
            'hours_before' => $hoursBefore,
            'custom_date_id' => $customDate->id,
        ];
    }
}
