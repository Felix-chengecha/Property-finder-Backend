<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amenities extends Model
{
    use HasFactory;

    protected $fillable= [
      'properties_id',
      'amenities'
    ];
    public function properties(){
        return $this->belongsTo(properties::class);
    }
}
