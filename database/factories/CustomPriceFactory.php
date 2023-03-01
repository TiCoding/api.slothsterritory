<?php

namespace Database\Factories;

use App\Models\CustomDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $adultPrice = $this->faker->randomFloat(2, 0, 50);
        $childPrice = $this->faker->randomFloat(2, 0, 50);
        $customDate = CustomDate::all()->unique()->random();

        return [
            'adult_price' => $adultPrice,
            'child_price' => $childPrice,
            'custom_date_id' => $customDate->id,
        ];
    }
}
