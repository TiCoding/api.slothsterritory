<?php

namespace Database\Factories;

use App\Models\AgencyTour;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month');
        $agencyTour = AgencyTour::all()->random();

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'agency_tour_id' => $agencyTour->id,
        ];
    }
}
