<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    /**
     * @return Payment Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }
}
