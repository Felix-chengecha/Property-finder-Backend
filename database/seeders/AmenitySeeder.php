<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
           \App\Models\amenities::factory(20)->create();
    }
}
