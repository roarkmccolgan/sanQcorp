<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bucket extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'username',
    	'email',
    	'message',
    	'calendar',
    	'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];



    public function setCalendarAttribute($date){
    	$this->attributes['calendar'] = Carbon::parse($date);
    }

    /**
    * Get the user that owns the Bucket.
    */
    public function user()
    {
       return $this->belongsTo('App\User');
    }
}
