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
     * The UploadFile instance.
     * 
     * @var UploadedsFile
     */
    protected $file;

    /**
     * When a photo is created, prepare a thumbnail, too.
     * 
     * @return void
     */
    public static function boot()
    {
        static::creating(function ($photo) {
            return $photo->upload();
        });
    }

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
     * Make a new photo instance of an uploaded file.
     * 
     * @param  UploadedFile $file
     * @return self
     */
    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;
        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
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

    /**
     * Get the file name for the photo.
     * 
     * @return string
     */
    public function fileName()
    {
        $name = sha1(time() . $this->file->getClientOriginalName());
        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Get the path for the photo.
     * 
     * @return string
     */
    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    /**
     * Get the path to the photo thumbnail.
     * 
     * @return string
     */
    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }


    /**
     * Upload the photo to the proper folder.
     * @return self
     */
    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());
        
        $this->makeThumbnail();

        return $this;
    }

    /**
     * Create a thumbnail for a photo
     * @return void
     */
    protected function makeThumbnail()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }
}
