<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'rate',
        'alias',
        'unit_of_measure'
    ];


    /**
     * @return Tasks Scope
     */
    public function scope()
    {
        return $this->belongsToMany('App\Scope', 'scope_task', 'task_id', 'scope_id');
    }

    /**
     * @return Tasks Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials', 'material_task', 'task_id', 'material_id')->withPivot('area','coverage');
    }

    /**
     * @return Tasks Properties
     */
    public function properties()
    {
        return $this->belongsToMany('App\Property', 'property_task', 'task_id','property_id')->withPivot('conversion');
    }

    /**
     * @return Tasks Options
     */
    public function options()
    {
        return $this->belongsToMany('App\Option', 'option_task', 'task_id', 'option_id');
    }

    /**
     * @return Tasks Variables
     */
    public function variables()
    {
        return $this->hasMany('App\TaskVariable');
    }

}
