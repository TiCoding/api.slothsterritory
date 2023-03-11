<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencyData;
use App\Models\AgencyTour;
use App\Models\Commission;
use App\Models\CustomDate;
use App\Models\Customer;
use App\Models\CustomPrice;
use App\Models\CustomSchedule;
use App\Models\Fee;
use App\Models\Guide;
use App\Models\GuideStatus;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::factory(2)->create();
        $this->call(UserSeeder::class);
        ReservationStatus::factory(3)->create();
        Customer::factory(10)->create();
        PaymentStatus::factory(3)->create();
        PaymentType::factory(3)->create();
        PaymentMethod::factory(4)->create();
        Payment::factory(10)->create();
        GuideStatus::factory(2)->create();
        Guide::factory(5)->create();
        Tour::factory(3)->create();
        Schedule::factory(5)->create();
        TourGroup::factory(30)->create();
        Agency::factory(10)->create();
        Reservation::factory(50)->create();
        Fee::factory(50)->create();
        AgencyData::factory(3)->create(); // Check this
        Commission::factory(3)->create(); // Check this


        AgencyTour::factory(4)->create();

        // CustomDate::factory(5)->create();
        CustomDate::create([ 'start_date' => '2000-01-01', 'end_date' => '2005-01-01', 'agency_tour_id' => 1, ]);
        CustomDate::create([ 'start_date' => '2010-01-01', 'end_date' => '2015-01-01', 'agency_tour_id' => 2, ]);
        CustomDate::create([ 'start_date' => '2016-01-01', 'end_date' => '2020-01-01', 'agency_tour_id' => 3, ]);
        CustomDate::create([ 'start_date' => '2021-01-01', 'end_date' => '2023-01-01', 'agency_tour_id' => 4, ]);


        CustomSchedule::factory(3)->create();
        CustomPrice::factory(1)->create();




    }
}
