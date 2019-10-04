<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['start_date', 'requested_start_date'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    public function barcode()
    {
        return $this->morphOne('App\Barcode', 'barcodable');
    }

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    /**
     * @return Jobs Contacts
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }


    /**
     * @return Job Sections
     */
    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    /**
     * @return Job Options
     */
    public function options()
    {
        return $this->hasManyThrough('App\Option', 'App\Section');
    }

    /**
     * @return Jobs Logs
     */
    public function log()
    {
        return $this->hasMany('App\Log');
    }
    
    /**
     * @return Jobs Payments
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
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
        return $this->hasMany('App\Revision');
    }

    /**
     * @return Job Terms
     */
    public function terms()
    {
        return $this->belongsToMany('App\Term');
    }

     /**
     * @return Job Includes
     */
    public function jobincludes()
    {
        return $this->belongsToMany('App\JobInclude');
    }

    /**
     * Get all of the Jobs Files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
