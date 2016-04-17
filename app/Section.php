<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    protected $fillable = [
        'name',
        'survey'
    ];

    /**
     * @return Section Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }

    /**
     * @return Section task
     */
    public function options()
    {
        return $this->hasMany('App\Option');
    }
}
