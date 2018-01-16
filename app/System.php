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
        'type'
    ];

    /**
     * @return System Scopes
     */
    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    /**
     * @return System Options
     */
    // public function options()
    // {
    //     return $this->hasMany('App\Option');
    // }

    /**
     * @return System Tasks
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks', 'system_task', 'system_id', 'task_id')->withPivot('order')->orderBy('pivot_order');
    }

    /**
     * Get all of the Sections photos.
     */
    public function photos()
    {
        return $this->morphMany('App\Photos', 'photoable');
    }

    // /**
    //  * @return System Materials by product_type
    //  */
    // public function materialsByType()
    // {
    //     return $this->belongsToMany('App\Materials', 'material_system', 'system_id', 'material_id')->keyBy('product_type');
    // }
    

    /**
     * @return System term
     */
    public function terms()
    {
        return $this->belongsToMany('App\Term');
    }

    /**
     * @return System labour
     */
    public function labour()
    {
        return $this->belongsToMany('App\Labour')->withPivot('qty');
    }

    /**
     * Get the guarantee record associated with the system.
     */
    public function guarantee()
    {
        return $this->belongsTo('App\Guarantees', 'guarantee_id');
    }
}
