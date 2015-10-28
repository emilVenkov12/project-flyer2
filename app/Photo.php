<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class Photo extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

	/**
	 * A photo belongs to one flyer.
     * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }

    /**
     * Get the base dir for photo upload.
     * 
     * @return string
     */
    public function baseDir()
    {
        return 'images/photos';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        
        //since the path and the thumbnail path are connected with the name
        //will update them too
        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }
}
