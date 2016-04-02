<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    /**
     * @return System Scopes
     */
    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    /**
     * @return System Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials');
    }
}
