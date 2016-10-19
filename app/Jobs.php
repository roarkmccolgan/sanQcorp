<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'requested_start_date'];

    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'accepted',
        'name',
        'start_date',
        'requested_start_date',
        'distance',
        'status',
        'estate',
        'estate_address',
        'estate_suburb',
        'address',
        'suburb',
        'city',
        'country'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->morphMany('App\Photos', 'photoable');
    }

    public function barcode()
    {
        return $this->morphOne('App\Barcodes', 'barcodable');
    }

    public function order()
    {
        return $this->hasOne('App\Order','job_id');
    }

    /**
     * @return Jobs Contacts
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contacts','contact_job','job_id','contact_id');
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
        return $this->hasMany('App\Payments');
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
        return $this->hasMany('App\Revision','job_id');
    }

    /**
     * @return Job Terms
     */
    public function terms()
    {
        return $this->belongsToMany('App\Term','job_term','job_id','term_id');
    }


}
