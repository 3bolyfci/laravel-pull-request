<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['photo'];

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
}
