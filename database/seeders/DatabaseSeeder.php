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
        // Role::factory(2)->create();
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Empleado']);
        Role::create(['name' => 'Desarrollador']);

        $this->call(UserSeeder::class);

        // ReservationStatus::factory(3)->create();
        ReservationStatus::create(['name' => 'Pendiente']);
        ReservationStatus::create(['name' => 'Llegó']);
        ReservationStatus::create(['name' => 'Cancelada']);

        Customer::factory(10)->create();

        // PaymentStatus::factory(3)->create();
        PaymentStatus::create(['name' => 'Pendiente']);
        PaymentStatus::create(['name' => 'Pagado']);

        // PaymentType::factory(3)->create();
        PaymentType::create(['name' => 'Reserva']);
        PaymentType::create(['name' => 'Comision']);
        PaymentType::create(['name' => 'Honorario']);

        // PaymentMethod::factory(4)->create();
        PaymentMethod::create(['name' => 'Efectivo']);
        PaymentMethod::create(['name' => 'Tarjeta']);
        PaymentMethod::create(['name' => 'Transferencia']);

        Payment::factory(10)->create();

        // GuideStatus::factory(2)->create();
        GuideStatus::create(['name' => 'Disponible']);
        GuideStatus::create(['name' => 'No disponible']);

        Guide::factory(5)->create();

        // Tour::factory(3)->create(); cerate 3 tours
        Tour::create(['name' => 'Tour Diurno', 'description' => 'Tour de perezosos', 'path_image' => 'https://picsum.photos/200/300', 'adult_price' => 50, 'child_price' => 30,]);
        Tour::create(['name' => 'Tour Nocturno', 'description' => 'Tour nocturno', 'path_image' => 'https://picsum.photos/200/300', 'adult_price' => 50, 'child_price' => 30,]);
        Tour::create(['name' => 'Tour Aves', 'description' => 'Tour de aves', 'path_image' => 'https://picsum.photos/200/300', 'adult_price' => 60, 'child_price' => 40,]);

        // Schedule::factory(5)->create(); //TODO: change this to manual creation
        Schedule::create(['schedule' => '8:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '9:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '10:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '11:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '13:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '14:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '15:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 1,]);
        Schedule::create(['schedule' => '17:30', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 2,]);
        Schedule::create(['schedule' => '18:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 2,]);
        Schedule::create(['schedule' => '05:00', 'capacity' => 20, 'hours_before' =>  5, 'tour_id' => 3,]);



        TourGroup::factory(30)->create();

        Agency::factory(10)->create();

        Reservation::factory(50)->create();

        Fee::factory(30)->create();

        AgencyData::factory(3)->create(); // Check this

        Commission::factory(3)->create(); // Check this

        AgencyTour::factory(4)->create();

        // CustomDate::factory(5)->create();
        CustomDate::create(['start_date' => '2000-01-01', 'end_date' => '2005-01-01', 'agency_tour_id' => 1,]);
        CustomDate::create(['start_date' => '2010-01-01', 'end_date' => '2015-01-01', 'agency_tour_id' => 2,]);
        CustomDate::create(['start_date' => '2016-01-01', 'end_date' => '2020-01-01', 'agency_tour_id' => 3,]);
        CustomDate::create(['start_date' => '2021-01-01', 'end_date' => '2023-01-01', 'agency_tour_id' => 4,]);


        // CustomSchedule::factory(3)->create();
        CustomSchedule::create(['schedule' => '8:00', 'capacity' => 20, 'hours_before' => 5, 'custom_date_id' => 4,]);
        CustomSchedule::create(['schedule' => '9:00', 'capacity' => 20, 'hours_before' => 5, 'custom_date_id' => 4,]);
        CustomSchedule::create(['schedule' => '10:00', 'capacity' => 20, 'hours_before' => 5, 'custom_date_id' => 4,]);
        CustomSchedule::create(['schedule' => '11:00', 'capacity' => 20, 'hours_before' => 5, 'custom_date_id' => 2,]);


        // CustomPrice::factory(1)->create();
        CustomPrice::create(['adult_price' => 60, 'child_price' => 50, 'custom_date_id' => 1,]);
        CustomPrice::create(['adult_price' => 65, 'child_price' => 45, 'custom_date_id' => 4,]);
    }
}
