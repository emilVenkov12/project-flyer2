<?php

namespace App;

use Image;

class Thumbnail
{
	public function make($source, $destination)
	{
		Image::make($source)
            ->fit(200)
            ->save($destination);
	}
}
