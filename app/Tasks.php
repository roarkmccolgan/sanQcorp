<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'unit_of_measure'
    ];


    /**
     * @return Tasks System
     */
    public function systems()
    {
        return $this->belongsToMany('App\System', 'system_task', 'task_id', 'system_id');
    }

    /**
     * @return Tasks Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials', 'material_task', 'task_id', 'material_id');
    }

    /**
     * @return Tasks Options
     */
    public function options()
    {
        return $this->belongsToMany('App\Option', 'option_task', 'task_id', 'option_id');
    }

}
