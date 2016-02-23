<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	// by default the pluralized version of the class would be used
	protected $table = 'flyer_photos';
	
	protected $fillable = ['photo'];

	public function flyer()
	{
		return $this->belongsTo('App\Flyer');
    }
}
