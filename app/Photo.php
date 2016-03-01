<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

// don't really like this class...seems murky and would think it violates principles like single responsibility

class Photo extends Model
{
	// by default the pluralized version of the class would be used
	protected $table = 'flyer_photos';

	protected $fillable = ['name', 'path', 'thumbnail_path'];

	/**
	 * A photo belongs to a single flyer.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function flyer()
	{
		return $this->belongsTo('App\Flyer');
	}

	public function setNameAttribute($name)
	{
		$this->attributes['name'] = $name;

		$this->path = $this->baseDir() . '/' . $name;
		$this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
	}

	public function baseDir()
	{
		return 'flyers/photos';
	}

	// override the delete method and defer to it up the chain
	public function delete()
	{
		\File::delete([
			$this->path,
			$this->thumbnail_path
		]);
		parent::delete();
	}
}
