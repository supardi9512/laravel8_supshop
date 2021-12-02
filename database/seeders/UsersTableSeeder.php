<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        User::create(
            [
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('admin'),
            ]
        );
    }
}
