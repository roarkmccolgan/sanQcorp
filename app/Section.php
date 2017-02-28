<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	protected $table = 'section';

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'properties' => 'array',
	];

	protected $fillable = [
		'name',
		'accepted',
		'survey',
		'properties',
	];

	/**
	 * @return Section Job
	 */
	public function job()
	{
		return $this->belongsTo('App\Jobs', 'jobs_id');
	}

	/**
	 * @return Section task
	 */
	public function options()
	{
		return $this->hasMany('App\Option');
	}

	/**
	 * @return Section properties
	 */
	public function properties()
	{
		return $this->hasMany('App\Property');
	}

	/**
	 * Get all of the Sections photos.
	 */
	public function photos()
	{
		return $this->morphMany('App\Photos', 'photoable');
	}
}
