<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
		'survey'
    ];
    public $timestamps = false;
}
