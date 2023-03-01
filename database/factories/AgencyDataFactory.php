<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $agentName = $this->faker->name;
        $reservation = Reservation::all()->unique()->random();

        return [
            'agent_name' => $agentName,
            'reservation_id' => $reservation->id,
        ];
    }
}
