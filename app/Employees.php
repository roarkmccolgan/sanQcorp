<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'day_rate',
        'cell',
        'id_num',
        'image',
        'nok_name',
        'nok_number',
        'fp_id',
        'card_id',
        'payroll',
        'clocked'
    ];

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
