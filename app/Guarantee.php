<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    protected $guarded = [];

    /**
     * Get the systems who own the guarantee.
     */
    public function systems()
    {
        return $this->hasMany(\App\System::class);
    }
}
