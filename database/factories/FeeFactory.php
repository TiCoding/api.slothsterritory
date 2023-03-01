<?php

namespace Database\Factories;

use App\Models\PaymentStatus;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $amountDollars = $this->faker->numberBetween(1, 100);
        $amountColones = $this->faker->numberBetween(0, 99);
        $paymentStatus = PaymentStatus::all()->random();
        $reservation = $this->faker->unique()->numberBetween(1,50); //Reservation::all()->unique()->random();

        return [
            'amount_dollars' => $amountDollars,
            'amount_colones' => $amountColones,
            'payment_status_id' => $paymentStatus->id,
            'reservation_id' => $reservation, //$reservation->id,
        ];
    }
}
