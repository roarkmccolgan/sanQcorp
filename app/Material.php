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
        return $this->morphOne(\App\Barcode::class, 'barcodable');
    }

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function logs()
    {
        return $this->belongsToMany(\App\Log::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(\App\Task::class)->withPivot('area');
    }

    public function options()
    {
        return $this->belongsToMany(\App\Option::class);
    }
}
