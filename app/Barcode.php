<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    protected $guarded = [];

    public function barcodeable()
    {
        return $this->morphTo();
    }
}