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
    	'calendar',
    	'user_id'
    ];

    public function setCalendarAttribute($date){
    	$this->attributes['calendar'] = Carbon::parse($date);
    }

    /**
    * Get the post that owns the comment.
    */
    public function user()
    {
       return $this->belongsTo('App\User');
    }
}
