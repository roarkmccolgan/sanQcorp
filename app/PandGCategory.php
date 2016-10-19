<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PandGCategory extends Model
{
    protected $table = 'pandg_category';

    protected $fillable = [
		'name'
    ];

    /**
     * @return PandGs
     */
    public function options()
    {
        return $this->hasMany('App\PandG');
    }
}