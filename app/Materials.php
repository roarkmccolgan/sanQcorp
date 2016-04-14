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
     * @return Material Logs
     */
    public function logs()
    {
        return $this->belongsToMany('App\Log');
    }

    /**
     * @return Materials tasks
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks', 'material_task', 'material_id', 'task_id');
    }
}
