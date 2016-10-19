<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'cell'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return Users buckets
     */
    public function buckets()
    {
        return $this->hasMany('App\Bucket');
    }

    /**
     * @return Users Jobs
     */
    public function jobs()
    {
        return $this->hasMany('App\Jobs');
    }
}
