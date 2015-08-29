<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Flyer extends Model
{
    /**
     * The attributes that are mass assignable.
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
     * Find flyer located at given zip and street.
     * @param  string $zip
     * @param  string $street
     * @return self
     */
    public static function locatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);

        return static::where(compact('zip', 'street'))->firstOrFail();
    }

    /**
     * Add photo to the flyer.
     * @param Photo $photo
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * A flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }

    /**
     * A flyer is owned by user.
     * @return \Illuminate\Database\Eloquent\Ralations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if the given user created the flyer.
     * @param  User   $user
     * @return boolean
     */
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }
}
