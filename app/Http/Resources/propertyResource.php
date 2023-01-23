<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class propertyResource extends JsonResource
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
            'cost'=>$this->cost,
            'location'=>$this->loc_name,
            'display'=>$this->display,
        ];
    }
}
