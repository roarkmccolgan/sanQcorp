<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    protected $fillable = [
        'name',
        'description',
        'system_id',
        'size',
        'perimeter',
        'difficulty',
        'pitch',
        'length',
        'height',
        'width',
        'labour_estimate',
        'supervisor_estimate',
        'days_estimate',
        'total_estimate',
        'total_selling',
        'markup'
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
        return $this->belongsToMany('App\Tasks','option_task','option_id','task_id')->withPivot('total', 'done', 'complete');
    }

    /**
     * @return Option System
     */
    public function system()
    {
        return $this->belongsTo('App\System');
    }
}
