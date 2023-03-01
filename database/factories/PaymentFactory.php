<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $dollarAmount = $this->faker->randomFloat(2, 0, 100);
        $colonesAmount = $dollarAmount * 600;
        $paymentDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $pathFile = 'https://picsum.photos/200/300';
        $paymentMethod = PaymentMethod::all()->random();
        $paymentType = PaymentType::all()->random();
        $paymentable_type = $this->faker->randomElement(['App\Models\Reservation', 'App\Models\Commission', 'App\Models\Fee']);
        $paymentable_id = $this->faker->numberBetween(1, 50);

        return [
            'dollar_amount' => $dollarAmount,
            'colones_amount' => $colonesAmount,
            'payment_date' => $paymentDate,
            'path_file' => $pathFile,
            'payment_method_id' => $paymentMethod->id,
            'payment_type_id' => $paymentType->id,
            'paymentable_type' => $paymentable_type,
            'paymentable_id' => $paymentable_id,
        ];
    }
}
