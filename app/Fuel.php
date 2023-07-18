<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    protected $guarded = [];

    public function getRatePerKmAttribute($value)
    {
        return $value / 100;
    }

    public function setRatePerKmAttribute($value)
    {
        $this->attributes['rate_per_km'] = $value * 100;
    }
}
