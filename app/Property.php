<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function systems()
    {
        return $this->hasMany('App\System');
    }
}
