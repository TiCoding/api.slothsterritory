<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->company;
        $commissionDollar = $this->faker->randomFloat(2, 0, 100);
        $commissionPercent = $this->faker->randomFloat(0, 0, 10);
        $color = $this->faker->hexColor;
        $email = $this->faker->unique()->safeEmail;

        return [
            'name' => $name,
            'commission_dollars' => $commissionDollar,
            'commission_percent' => $commissionPercent,
            'color' => $color,
            'email' => $email,
        ];
    }
}
