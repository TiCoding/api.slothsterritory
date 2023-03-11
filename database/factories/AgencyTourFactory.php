<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyTourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $agency = Agency::all()->random();
        $tour = Tour::all()->random();
        // $adultPrice = $this->faker->randomFloat(2, 0, 100);
        // $childPrice = $this->faker->randomFloat(2, 0, 100);

        return [
            // 'adult_price' => $adultPrice,
            // 'child_price' => $childPrice,
            'agency_id' => $agency->id,
            'tour_id' => $tour->id,
        ];
    }
}
