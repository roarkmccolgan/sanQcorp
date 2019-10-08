<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Labour extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function system()
	{
		return $this->belongsToMany('App\System');
	}
}
