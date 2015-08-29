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
     * Basic directory where the photo are uploaded.
     * @var string
     */
    protected $baseDir = 'flyer/photos';

	/**
	 * A photo belongs to one flyer.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }

    /**
     * Build a new photo instance from a file upload.
     * @param  string $name
     * @return self
     */
    public static function named($name)
    {
        return (new static)->saveAs($name);
    }
    
    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);
        
        $this->makeThumbnail();

        return $this;
    }

    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}
