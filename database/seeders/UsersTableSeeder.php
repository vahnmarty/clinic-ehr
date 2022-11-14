<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
        $this->createProvider();
        $this->createClinicalSupport();
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
        $user->name = "Clinical Support";
        $user->password = bcrypt('password');
        $user->save();

        $user->assignRole('clinical support');

    }
}
