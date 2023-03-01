<?php

namespace Database\Factories;

use App\Models\PaymentStatus;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $amountDollars = $this->faker->randomFloat(2, 0, 100);
        $amountColones = $this->faker->randomFloat(2, 0, 100);
        $paymentStatus = PaymentStatus::all()->random();
        $reservation = Reservation::all()->unique()->random();

        return [
            'amount_dollars' => $amountDollars,
            'amount_colones' => $amountColones,
            'payment_status_id' => $paymentStatus->id,
            'reservation_id' => $reservation->id,
        ];
    }
}
