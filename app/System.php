<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $guarded = [];

    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withPivot('order')->orderBy('pivot_order');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Term');
    }

    public function labour()
    {
        return $this->belongsToMany('App\Labour')->withPivot('qty');
    }
}
