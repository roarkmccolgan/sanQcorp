<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class Contacts extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'company_id',
    	'first_name',
        'last_name',
        'job_title',
        'department',
        'region',
        'country',
        'contact1',
        'contact2',
        'contact3',
        'email',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

    /**
     * @return Contacts Company
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * @return Contacts Jobs
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Jobs');
    }
}
