<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    protected $dates = ['completed_at'];

    protected $casts = ['properties' => 'array'];

    public function job()
    {
        return $this->belongsTo(\App\Job::class);
    }

    public function options()
    {
        return $this->hasMany(\App\Option::class);
    }

    public function properties()
    {
        return $this->belongsToMany(\App\Property::class)->withPivot(['value']);
    }

    public function photos()
    {
        return $this->morphMany(\App\Photo::class, 'photoable');
    }
}
