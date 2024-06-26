<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->unique()->randomElement(['Administrador', 'Empleado', 'Desarrollador']);

        return [
            'name' => $name,
        ];
    }
}
