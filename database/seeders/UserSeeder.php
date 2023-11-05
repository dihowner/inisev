<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => $faker->unique()->name,
                'email' => 'user'.$i.'@raheem.com',
                'password' => bcrypt('12345'),
            ]);
        }
    }
}
