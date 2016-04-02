<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    use SoftDeletes;

    public function barcode()
    {
        return $this->morphOne('App\Barcodes', 'barcodable');
    }

    /**
     * @return Jobs Contacts
     */
    public function contacts()
    {
        return $this->belongToMany('App\Contacts');
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
