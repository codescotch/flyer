<?php

namespace App;

use App\AddPhotoToFlyer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Mockery as m;

class AddPhotoToFlyerTest extends \TestCase
{
	/** @test */
	function it_processes_a_form_to_add_a_photo_to_a_flyer()
	{
		// replicate what happens in the class, and verify everything that should happen did happen
		$flyer = factory(Flyer::class)->create();

		// creates a mock object
		$file = m::mock(UploadedFile::class, [
			'getClientOriginalName'      => 'foo',
			'getClientOriginalExtension' => 'jpg'
		]);

		// makes sure proper instructions are sent to the object's method
		$file->shouldReceive('move')
			 ->once()
			 ->with('flyers/photos', 'nowfoo.jpg');

		$thumbnail = m::mock(Thumbnail::class);
		$thumbnail->shouldReceive('make')
				  ->once()
				  ->with('flyers/photos/nowfoo.jpg', 'flyers/photos/tn-nowfoo.jpg');

		(new AddPhotoToFlyer($flyer, $file, $thumbnail))->save();

		$this->assertCount(1, $flyer->photos);

	}

}

// this is necessary in order to test with time() method
// aka stubbing it out
// IMPORTANT: must be outside class
function time()
{
	return 'now';
}

// stubbing it out
function sha1($path) { return $path; }