<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->unique()->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']);

        return [
            'name' => $name,
        ];
    }
}
