<?php

namespace App\Http\Resources;

use Faker\Guesser\Name;
use Illuminate\Http\Resources\Json\JsonResource;

class detailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'category'=>$this->category,
            'type'=>$this->type,
            'description'=>$this->description,
            'owner'=>$this->owner_contact,
            'cost'=>$this->cost,
            'location'=>$this->loc_name,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
        ];
    }
}
