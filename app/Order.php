<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'job_id',
        'contact_id',
        'user_id'
    ];

    /**
     * @return Order Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }

    /**
     * Get all of the Sections photos.
     */
    public function files()
    {
        return $this->morphMany('App\Files', 'fileable');
    }
}
