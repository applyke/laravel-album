<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    public function images()
    {
        return $this->hasMany('App\Model\Image');
    }


}
