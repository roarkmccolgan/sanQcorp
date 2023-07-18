<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['start_date', 'requested_start_date'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function photos()
    {
        return $this->morphMany(\App\Photo::class, 'photoable');
    }

    public function barcode()
    {
        return $this->morphOne(\App\Barcode::class, 'barcodable');
    }

    public function order()
    {
        return $this->hasOne(\App\Order::class);
    }

    /**
     * @return Jobs Contacts
     */
    public function contacts()
    {
        return $this->belongsToMany(\App\Contact::class);
    }

    /**
     * @return Job Sections
     */
    public function sections()
    {
        return $this->hasMany(\App\Section::class);
    }

    /**
     * @return Job Options
     */
    public function options()
    {
        return $this->hasManyThrough(\App\Option::class, \App\Section::class);
    }

    /**
     * @return Jobs Logs
     */
    public function log()
    {
        return $this->hasMany(\App\Log::class);
    }

    /**
     * @return Jobs Payments
     */
    public function payments()
    {
        return $this->hasMany(\App\Payment::class);
    }

    /**
     * @return Job PandGs
     */
    public function pandg()
    {
        return $this->hasMany('App\PandG');
    }

    /**
     * @return Job Revisions
     */
    public function revisions()
    {
        return $this->hasMany(\App\Revision::class);
    }

    /**
     * @return Job Terms
     */
    public function terms()
    {
        return $this->belongsToMany(\App\Term::class);
    }

    /**
     * @return Job Includes
     */
    public function jobincludes()
    {
        return $this->belongsToMany(\App\JobInclude::class);
    }

    /**
     * Get all of the Jobs Files.
     */
    public function files()
    {
        return $this->morphMany(\App\File::class, 'fileable');
    }
}
