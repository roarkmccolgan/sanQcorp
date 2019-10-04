<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PandgCategory extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany('App\Pandg');
    }
}
