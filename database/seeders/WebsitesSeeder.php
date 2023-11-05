<?php

namespace Database\Seeders;

use App\Models\Websites;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WebsitesSeeder extends Seeder
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
            Websites::create([
                'website_url' => $faker->unique()->url,
            ]);
        }
    }
}
