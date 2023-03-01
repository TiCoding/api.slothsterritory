<?php

namespace Database\Factories;

use App\Models\AgencyTour;
use App\Models\Guide;
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
        $guide = Guide::all()->random();

        return [
            'name' => $name,
            'guide_id' => $guide->id,
        ];
    }
}
