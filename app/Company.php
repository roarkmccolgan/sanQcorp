<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //use SoftDeletes;

    protected $table = 'company';

    protected $fillable = [
    	'name',
        'address1',
        'address2',
        'address3',
        'post_code',
        'vat'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

    /**
     * @return Companies Contacts
     */
    public function contacts()
    {
        return $this->hasMany('App\Contacts');
    }
}
