<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';

    protected $fillable = [
        'name',
        'unit',
        'base_rate',
        'component'
    ];

    /**
     * @return System Scopes
     */
    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    /**
     * @return System Tasks
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks', 'system_task', 'system_id', 'task_id');
    }

    // /**
    //  * @return System Materials by product_type
    //  */
    // public function materialsByType()
    // {
    //     return $this->belongsToMany('App\Materials', 'material_system', 'system_id', 'material_id')->keyBy('product_type');
    // }
}
