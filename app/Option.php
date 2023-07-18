<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany(\App\Log::class);
    }

    public function nightshift()
    {
        return $this->hasOne(\App\Nightshift::class);
    }

    public function section()
    {
        return $this->belongsTo(\App\Section::class);
    }

    public function tasks()
    {
        //return $this->belongsToMany('App\Task',)->withPivot('order','days','difficulty','total_labour_price','total_supervisor_price','total_materials_price','total_cost_price','total', 'done', 'complete', 'variable_id')->orderBy('pivot_order');
        return $this->belongsToMany(\App\Task::class)->withPivot('order', 'days', 'difficulty', 'total_labour_price', 'total_supervisor_price', 'total_materials_price', 'total_cost_price', 'total', 'done', 'complete', 'variable_id', 'property_value')->orderBy('pivot_order');
    }

    public function properties()
    {
        return $this->belongsToMany(\App\Property::class)->withPivot('value');
    }

    public function materials()
    {
        return $this->belongsToMany(\App\Material::class)->withPivot('qty', 'price', 'cost_price', 'task');
    }

    public function system()
    {
        return $this->belongsTo(\App\System::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }
}
