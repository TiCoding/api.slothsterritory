<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->unique()->randomElement(['Tour Diurno', 'Tour Nocturno', 'Tour Aves']);
        $description = $this->faker->text(200);
        $pathImage = 'https://picsum.photos/200/300';

        return [
            'name' => $name,
            'description' => $description,
            'path_image' => $pathImage,
        ];
    }
}
