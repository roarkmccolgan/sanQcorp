<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nightshift extends Model
{
    protected $guarded = [];

    /**
     * @return Option
     */
    public function option()
    {
        return $this->belongsTo(\App\Option::class);
    }

    public function labours()
    {
        return $this->belongsToMany(\App\Labour::class)->withPivot('qty');
    }
}
