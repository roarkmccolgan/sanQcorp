<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    public function sections()
    {
        return $this->hasMany(\App\Section::class);
    }

    public function options()
    {
        return $this->hasMany(\App\Option::class)->withPivot('value');
    }

    public function systems()
    {
        return $this->hasMany(\App\System::class);
    }
}
