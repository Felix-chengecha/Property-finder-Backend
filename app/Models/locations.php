<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;

    protected $fillable=[
        'properties_id',
        'longitude',
        'latitude',
    ];


    public function properties(){
        return $this->belongsTo(properties::class);
    }
}
