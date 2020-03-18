<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Labour extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getDayRateAttribute($value)
    {
        return $value / 100;
    }

    public function setDayRateAttribute($value)
    {
        $this->attributes['day_rate'] = $value * 100;
    }

    public function system()
    {
        return $this->belongsToMany(\App\System::class);
    }
}
