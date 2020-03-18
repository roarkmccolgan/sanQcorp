<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $guarded = [];

    public function getBaseRateAttribute($value)
    {
        return $value / 100;
    }

    public function setBaseRateAttribute($value)
    {
        $this->attributes['base_rate'] = $value * 100;
    }

    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    public function tasks()
    {
        return $this->belongsToMany(\App\Task::class)->withPivot('order')->orderBy('pivot_order');
    }

    public function photos()
    {
        return $this->morphMany(\App\Photo::class, 'photoable');
    }

    public function terms()
    {
        return $this->belongsToMany(\App\Term::class);
    }

    public function labour()
    {
        return $this->belongsToMany(\App\Labour::class)->withPivot('qty');
    }

    public function guarantee()
    {
        return $this->belongsTo(\App\Guarantee::class, 'guarantee_id');
    }
}
