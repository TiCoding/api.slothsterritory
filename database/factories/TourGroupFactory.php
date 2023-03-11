<?php

namespace Database\Factories;

use App\Models\AgencyTour;
use App\Models\Guide;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->randomElement(['Grupo 1', 'Grupo 2']);
        $date = $this->faker->dateTimeBetween('now', '+1 month');
        $schedule = Schedule::all()->random();
        $guide = Guide::all()->random();

        return [
            'name' => $name,
            'date' => $date,
            'schedule' => $schedule->schedule,
            'guide_id' => $guide->id,
        ];
    }
}
