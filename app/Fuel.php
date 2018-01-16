<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $dates = ['valid_from', 'valid_to'];
    protected $table = 'fuel';

    protected $fillable = [
        'type',
        'price',
        'rate_per_km',
    ];

}
