<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $fillable = [
    	'username',
    	'email',
    	'message',
    	'calendar'
    ];

    public function setCalendarAttribute($date){
    	$this->attributes['calendar'] = Carbon::parse($date);
    }
}
