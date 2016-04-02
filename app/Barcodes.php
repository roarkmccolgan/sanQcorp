<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcodes extends Model
{
    protected $fillable = [
    	'barcode'
    ];

    /**
     * Get all of the owning barcodable models.
     */
    public function barcodeable()
    {
        return $this->morphTo();
    }
}
