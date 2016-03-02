<?php

namespace App;

use Image;

class Thumbnail
{
	public function make($src, $destination)
	{
		// using Image facade library methods not laravel methods obv
		Image::make($src)
			// creates 200x200 image
			->fit(200)
			->save($destination);
	}
}