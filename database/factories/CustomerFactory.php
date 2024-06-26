<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $phone = $this->faker->unique()->phoneNumber;

        return [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ];
    }
}
