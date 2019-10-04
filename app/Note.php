<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function option()
    {
        return $this->belongsTo('App\Option');
    }
}
