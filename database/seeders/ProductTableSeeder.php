<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::where('id','app')->first();

        $tenant->run(function () {

            Product::factory()->count(20)->create();
        });
    }
}
