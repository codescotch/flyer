<?php

namespace App;

use App\Flyer;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owns($relation)
    {
        // if statement isn't necessary
        return $relation->user_id == $this->id;
    }

    public function flyers()
    {
        // I guess Flyer::class is equivalent to writing 'App\Flyer'
        return $this->hasMany(Flyer::class);
    }

    public function publish(Flyer $flyer)
    {
        return $this->flyers()->save($flyer);
    }
}
