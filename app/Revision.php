<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revision';

    protected $fillable = [
    	'data'
    ];

    /**
     * @return Revision Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }
}
