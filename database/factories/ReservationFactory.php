<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\Customer;
use App\Models\PaymentStatus;
use App\Models\ReservationStatus;
use App\Models\Schedule;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $amountAdults = $this->faker->numberBetween(1, 5);
        $amountChildren = $this->faker->numberBetween(0, 3);
        $amountChildrenFree = $this->faker->numberBetween(0, 2);

        $adultPriceDollars = $this->faker->randomFloat(2, 0, 50);
        $adultPriceColones = $adultPriceDollars * 600;
        $childPriceDollars = $this->faker->randomFloat(2, 0, 50);
        $childPriceColones = $childPriceDollars * 600;

        $totalPriceDollar = $adultPriceDollars * $amountAdults + $childPriceDollars * $amountChildren;
        $totalPriceColones = $totalPriceDollar * 600;

        $discountDollars = $this->faker->randomFloat(2, 0, 10);
        $discountColones = $discountDollars * 600;

        $taxesDollars = $this->faker->randomFloat(2, 0, 10);
        $taxesColones = $taxesDollars * 600;

        $netPriceDollars = $totalPriceDollar - $discountDollars + $taxesDollars;
        $netPriceColones = $totalPriceColones - $discountColones + $taxesColones;

        $invoice = $this->faker->unique()->numberBetween(1, 9999);
        $comments = $this->faker->text(50);
        $date = $this->faker->dateTimeBetween('now', '+1 month');
        $schedule = Schedule::all()->random();

        $agency = Agency::all()->random();
        $customer = Customer::all()->random();
        $paymentStatus = PaymentStatus::all()->random();
        $reservationStatus = ReservationStatus::all()->random();
        $tour = Tour::all()->random();
        $tourGroup = TourGroup::all()->unique()->random();
        $user = User::all()->random();

        return [
            'amount_adults' => $amountAdults,
            'amount_children' => $amountChildren,
            'amount_children_free' => $amountChildrenFree,
            'adult_price_dollars' => $adultPriceDollars,
            'adult_price_colones' => $adultPriceColones,
            'child_price_dollars' => $childPriceDollars,
            'child_price_colones' => $childPriceColones,
            'total_price_dollars' => $totalPriceDollar,
            'total_price_colones' => $totalPriceColones,
            'discount_dollars' => $discountDollars,
            'discount_colones' => $discountColones,
            'taxes_dollars' => $taxesDollars,
            'taxes_colones' => $taxesColones,
            'net_price_dollars' => $netPriceDollars,
            'net_price_colones' => $netPriceColones,
            'invoice' => $invoice,
            'comments' => $comments,
            'date' => $date,
            'schedule' => $schedule->schedule,
            'agency_id' => $agency->id,
            'customer_id' => $customer->id,
            'payment_status_id' => $paymentStatus->id,
            'reservation_status_id' => $reservationStatus->id,
            'tour_id' => $tour->id,
            'tour_group_id' => $tourGroup->id,
            'user_id' => $user->id,
        ];
    }
}
