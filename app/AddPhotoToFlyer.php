<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

// this is a service class or form object
// the location of this file could also be app/ or a dedicated space like app/flyers/

class AddPhotoToFlyer
{
	protected $flyer;
	protected $file;

	/**
	 * Create a new AddPhotoToFlyer form object.
	 *
	 * @param Flyer $flyer
	 * @param UploadedFile $file
	 * @param Thumbnail|null $thumbnail
	 */
	public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
	{
		$this->flyer = $flyer;
		$this->file = $file;
		$this->thumbnail = $thumbnail ?: new Thumbnail;
	}

	/**
	 * Process the form
	 *
	 * @return void
	 */
	public function save()
	{
		$photo = $this->flyer->addPhoto($this->makePhoto());

		// move the photo to images folder
		$this->file->move($photo->baseDir(), $photo->name);

		// generate thumbnail
		$this->thumbnail->make($photo->path, $photo->thumbnail_path);
	}

	/**
	 * Make a new photo instance.
	 *
	 * @return Photo
	 */
	protected function makePhoto()
	{
		return new Photo(['name' => $this->makeFileName()]);
	}

	/**
	 * Make a file name, based on the uploaded file.
	 *
	 * @return string
	 */
	protected function makeFileName()
	{
		$name = sha1(
			time() . $this->file->getClientOriginalName()
		);
		$extension = $this->file->getClientOriginalExtension();
		return "{$name}.{$extension}";
	}
}