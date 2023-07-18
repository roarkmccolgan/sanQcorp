<?php

namespace App;

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
        'user_id',
    ];

    public function setCalendarAttribute($date)
    {
        $this->attributes['calendar'] = Carbon::parse($date);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
