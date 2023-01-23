<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class properties extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'type',
        'category',
        'cost',
        'description',
        'contact'
    ];


    public function property_images(){
        return $this->hasMany(property_images::class);
    }


    public function locations(){
        return $this->hasMany(locations::class);
    }

    public function amenities(){
        return $this->hasMany(amenities::class);
    }
}
