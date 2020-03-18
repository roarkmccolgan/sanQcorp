<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function scope()
    {
        return $this->belongsToMany('App\Scope');
    }

    public function materials()
    {
        return $this->belongsToMany(\App\Material::class)->withPivot('area', 'coverage');
    }

    public function properties()
    {
        return $this->belongsToMany(\App\Property::class)->withPivot('conversion');
    }

    public function options()
    {
        return $this->belongsToMany(\App\Option::class);
    }

    public function variables()
    {
        return $this->hasMany(\App\TaskVariable::class);
    }
}
