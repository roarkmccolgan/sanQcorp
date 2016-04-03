<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'name',
        'distance',
        'status',
        'estate',
        'estate_address',
        'estate_suburb',
        'address',
        'suburb',
        'city',
        'country'
    ];

    public function barcode()
    {
        return $this->morphOne('App\Barcodes', 'barcodable');
    }

    /**
     * @return Jobs Contacts
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contacts');
    }


    /**
     * @return Job Sections
     */
    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    /**
     * @return Jobs Logs
     */
    public function log()
    {
        return $this->hasMany('App\Log');
    }

}
