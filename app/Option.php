<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    protected $fillable = [
        'name',
        'accepted',
        'description',
        'system_id',
        'total_labour',
        'days',
        'total_supervisor',
        'total_materials',
        'total_cost_price',
        'selling_price',
        'markup',
    ];

    /**
     * @return Option logs
     */
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    /**
     * @return Options section
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * @return Option tasks
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks','option_task','option_id','task_id')->withPivot('order','days','difficulty','total_labour_price','total_supervisor_price','total_materials_price','total_cost_price','total', 'done', 'complete')->orderBy('pivot_order');
    }
    /**
     * @return Option materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials','material_option','option_id','material_id')->withPivot('qty', 'price', 'cost_price','task');
    }

    /**
     * @return Option System
     */
    public function system()
    {
        return $this->belongsTo('App\System');
    }

    /**
     * @return Option logs
     */
    public function notes()
    {
        return $this->hasMany('App\Notes');
    }
}
