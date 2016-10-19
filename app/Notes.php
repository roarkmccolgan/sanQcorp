<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{

    protected $fillable = [
        'note'
    ];

    /**
     * @return Notes option
     */
    public function option()
    {
        return $this->belongsTo('App\Option');
    }
}
