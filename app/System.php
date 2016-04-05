<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';

    protected $fillable = [
        'name',
        'unit',
        'base_rate',
        'component'
    ];

    /**
     * @return System Scopes
     */
    public function scopes()
    {
        return $this->belongsToMany('App\Scope');
    }

    /**
     * @return System Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials');
    }
}
