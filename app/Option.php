<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task',)->withPivot('order','days','difficulty','total_labour_price','total_supervisor_price','total_materials_price','total_cost_price','total', 'done', 'complete')->orderBy('pivot_order');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material')->withPivot('qty', 'price', 'cost_price','task');
    }

    public function system()
    {
        return $this->belongsTo('App\System');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
