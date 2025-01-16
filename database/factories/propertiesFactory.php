<?php

namespace Database\Factories;

use  App\Models\properties;

use Illuminate\Database\Eloquent\Factories\Factory;

class propertiesFactory extends Factory
{

    protected $model = properties::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
   // $//locations = ["Athi River","Buruburu","Donholm","Eastleigh","Embakasi","Gigiri","Highridge","Hurlingham","Kangemi","Karen","Kasarani","Kawangware","Kibera","Kileleshwa","Kilimani","Kilimani","Kisumu Ndogo","Kitengela","Kyuna","Lang'ata","Lavington","Lavington","Loresho","Madaraka","Mathare","Mlolongo","Mountain View","Muthaiga","Ngara","Ngong","Njiru","Nyayo Estate","Pangani","Parklands","Pipeline","Ridgeways","Roysambu","Ruaraka","Runda","South B","South C","Spring Valley","Syokimau","Thika Road","Umoja","Upper Hill","Westlands","Woodley"];
    //$names =["Apartment","Bungalow","Maisonette","Villa","Townhouse","Condo","Cottage","Duplex","Penthouse","Studio","Farmhouse","Plot","Land","Commercial","Office Space","Retail Space","Warehouse","Industrial","Hotel","Resort","Guest House","Bed and Breakfast","Hostel","School","Hospital","Shopping Mall","Restaurant","Bar","Warehouse","Factory","Farm","Ranch","Vacant Land","Golf Course","Marina","Island","Castle","Mansion","Cave House","Houseboat","Treehouse","Igloo","Earth House","Boat House","Caravan","Other"];
        return [
            //
            'name' => $this->faker->word,
            'type' => $this->faker->word,
           // 'category' => $this->faker->randomElement($names),
            'category' => $this->faker->word,
            'cost' => $this->faker->randomFloat(2, 100, 1000),
            'description' => $this->faker->sentence,
            'owner_contact' => $this->faker->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
