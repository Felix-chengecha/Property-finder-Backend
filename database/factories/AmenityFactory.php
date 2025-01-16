<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amenityNames = ['Swimming Pool', 'Gym', 'Parking', 'WiFi', 'Air Conditioning', 'Pet-Friendly'];
        return [
            //
             // Fetch a random properties_id
             'properties_id' =>  $this->faker->randomNumber(),
           // 'amenity' => $this->faker->randomElement($amenityNames),
           'amenity' => $this->faker->word, 
           'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
