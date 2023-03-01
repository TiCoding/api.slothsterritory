<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ulises R.',
            'email' => 'uli.rp1999@gmail.com',
            'password' => '12345678',
            'role_id' => 1,
        ]);

        User::factory(5)->create();
    }
}
