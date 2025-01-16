<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'property_id' => $this->faker->unique()->randomNumber(5),
            'latitude' => $this->faker->latitude($min = -1.2921, $max = -1.2195),
            'longitude' => $this->faker->longitude($min = 36.6652, $max = 36.9258),
        ];
        
    }
}
