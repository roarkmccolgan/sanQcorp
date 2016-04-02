<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * @return Task logs
     */
    public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
