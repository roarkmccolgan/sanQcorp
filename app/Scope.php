<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    /**
     * @return Scope Systems
     */
    public function systems()
    {
        return $this->belongsToMany('App\System');
    }

    /**
     * @return Scope Tasks
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks');
    }
}
