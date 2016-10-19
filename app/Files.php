<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
    	'name',
        'meta'
    ];

    /**
     * Get all of the owning file models.
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
