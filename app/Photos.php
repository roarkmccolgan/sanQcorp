<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = [
    	'photo',
        'meta'
    ];

    /**
     * Get all of the owning photo models.
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
