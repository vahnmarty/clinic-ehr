<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::firstOrCreate(['id' => 'app']);

        $tenant->domains()->firstOrCreate([
            'domain' => 'app.' . env('APP_DOMAIN')
        ]);

        $tenant->run(function () {

            $this->createRoles();
            $this->createAdmin();
            $this->createProvider();
            $this->createClinicalSupport();
            $this->createPatients();
        });
    }

    public function createRoles()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $provider = Role::firstOrCreate(['name' => 'provider']);
        $support = Role::firstOrCreate(['name' => 'support']);
    }

    public function createAdmin()
    {
        $user = User::firstOrNew(['email' =>  'admin@app.com']);
        $user->name = "Admin";
        $user->password = bcrypt('password');
        $user->save();

        $user->assignRole('admin');

    }

    public function createProvider()
    {
        $user = User::firstOrNew(['email' =>  'provider@app.com']);
        $user->name = "Provider";
        $user->password = bcrypt('password');
        $user->save();

        $user->assignRole('provider');

    }

    public function createClinicalSupport()
    {
        $user = User::firstOrNew(['email' =>  'support@app.com']);
        $user->name = "Support";
        $user->password = bcrypt('password');
        $user->save();

        $user->assignRole('support');

    }

    public function createPatients()
    {
        $faker = \Faker\Factory::create();

        Patient::query()->delete();

        foreach(range(1, 20) as $rand){
            Patient::create([
                'patient_id' => '0000' . $rand,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'date_of_birth' => $faker->date()
            ]);
        }
        
    }
}
