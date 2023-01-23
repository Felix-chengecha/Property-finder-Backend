<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_images extends Model
{
    use HasFactory;

    protected $fillable=[
        'properties_id',
        'images'
    ];


    public function users(){
        return $this->belongsTo(User::class);
    }
}
