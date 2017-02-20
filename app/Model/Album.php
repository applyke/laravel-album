<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function images()
    {
        return $this->hasMany('App\Model\Image');
    }
}
