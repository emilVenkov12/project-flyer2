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
}
