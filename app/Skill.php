<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'rate'
    ];

    public function employees()
    {
        return $this->hasMany('App\Employees');
    }
}
