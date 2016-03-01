<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
	/**
	 * Fillable fields for a flyer.
	 *
	 * @var array
	 */
	protected $fillable = [
		'street',
		'city',
		'zip',
		'country',
		'state',
		'price',
		'description'
	];

	/**
	 * Find the flyer at the given address.
	 *
	 * IMPORTANT LESSON: always be mindful of laravel's name conventions
	 * This was previously scopeLocatedAt, which broke after refactoring to a static function
	 *
	 * @param $zip
	 * @param $street
	 * @return mixed
	 */
	public static function locatedAt($zip, $street)
	{
		// NOTE: we're assuming there can't be dashes in street names (would need more complex logic)
		$street = str_replace('-', ' ', $street);

		// firstOrFail(): to display proper 404 page, listen for model not found exception
		return static::where(compact('zip', 'street'))->firstOrFail();
	}

	/**
	 * Get the price for a given flyer.
	 *
	 * NOTE: getter or accessor method
	 *
	 * @param $price
	 * @return string
	 */
	public function getPriceAttribute($price)
	{
		return '$ ' . number_format($price);
	}

	/**
	 * A flyer is comprised of many photos.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos()
	{
		return $this->hasMany('App\Photo');
    }

	public function addPhoto(Photo $photo)
	{
		return $this->photos()->save($photo);
	}

	/**
	 * A flyer is owned by a user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function owner()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * Determine if the given user created the flyer
	 *
	 * @param User $user
	 * @return bool
	 */
	public function ownedBy(User $user)
	{
		return $this->user_id == $user->id;
	}
}
