<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskVariable extends Model
{
    protected $table = 'taskVariable';

    /**
     * @return Variable Task
     */
    public function task()
    {
        return $this->belongsTo('App\Tasks');
    }
}
