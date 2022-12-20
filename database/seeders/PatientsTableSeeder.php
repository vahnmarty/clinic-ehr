<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->run(function () {

            $faker = \Faker\Factory::create();

            foreach(range(1, 20) as $rand){
                Patient::create([
                    'patient_number' => '0000' . $rand,
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->email,
                    'date_of_birth' => $faker->dateTimeBetween('-7 years', now()),
                    'sex' => $faker->randomElement(['male', 'female']),
                    
                ]);
            }
        });

        
    }
}
