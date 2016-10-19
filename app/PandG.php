<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PandG extends Model
{
    protected $table = 'pandg';

    protected $fillable = [
		'name',
		'description',
        'pandg_category_id',
        'jobs_id',
		'rate',
        'qty',
		'period'
    ];
    /**
     * @return Job PandGs
     */
    public function jobs()
    {
        return $this->belongsTo('App\Jobs');
    }
    /**
     * @return CategoryType
     */
    public function category()
    {
        return $this->belongsTo('App\PandGCategory');
    }
}
