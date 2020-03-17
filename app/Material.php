<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getTasksAttribute()
    {
        return $this->getRelationValue('tasks')->keyBy('id');
    }

    public function getCostPriceAttribute($value)
    {
        return $value / 100;
    }

    public function setCostPriceAttribute($value)
    {
        $this->attributes['cost_price'] = $value * 100;
    }

    public function barcode()
    {
        return $this->morphOne('App\Barcode', 'barcodable');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function logs()
    {
        return $this->belongsToMany('App\Log');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withPivot('area');
    }

    public function options()
    {
        return $this->belongsToMany('App\Option');
    }
}
