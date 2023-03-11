<?php

namespace Database\Factories;

use App\Models\GuideStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->unique()->name;
        $guideStatus = GuideStatus::all()->where('name', 'Disponible')->first();

        return [
            'name' => $name,
            'guide_status_id' => $guideStatus->id,
        ];
    }
}
