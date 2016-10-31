<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    protected $fillable = [
        'name',
        'accepted',
        'survey',
        'size',
        'perimeter',
        'difficulty',
        'area',
        'pitch',
        'length',
        'height',
        'width'
    ];

    /**
     * @return Section Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs', 'jobs_id');
    }

    /**
     * @return Section task
     */
    public function options()
    {
        return $this->hasMany('App\Option');
    }

    /**
     * Get all of the Sections photos.
     */
    public function photos()
    {
        return $this->morphMany('App\Photos', 'photoable');
    }
}
