<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $withCount = ['posts'];
    protected $with = ['posts.photo'];
    protected $appends = ['post'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected static $booted = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected static $booted = [User::class => true];

    public function getPostAttribute()
    {
        // return $this->posts;
        return $this->getFillable();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function boly()
    {
        return 'ahmed';
    }

}
