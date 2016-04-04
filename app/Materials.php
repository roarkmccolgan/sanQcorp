<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Materials extends Model
{
	use SoftDeletes;

    public function barcode()
    {
        return $this->morphOne('App\Barcodes', 'barcodable');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    /**
     * @return Material Systems
     */
    public function systems()
    {
        return $this->belongsToMany('App\System');
    }

    /**
     * @return Material Logs
     */
    public function logs()
    {
        return $this->belongsToMany('App\Log');
    }
}
