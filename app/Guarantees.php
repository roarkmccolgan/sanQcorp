<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantees extends Model
{
    protected $fillable = [
		'description',
		'years',
		'maintenance',
		'custom'
	];

    /**
     * Get the systems who own the guarantee.
     */
    public function systems()
    {
        return $this->hasMany('App\System');
    }
}
