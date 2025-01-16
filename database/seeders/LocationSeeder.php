<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\locations;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     //   locations::factory()->count(20)->create();
     \App\Models\locations::factory(20)->create();
    }
}
