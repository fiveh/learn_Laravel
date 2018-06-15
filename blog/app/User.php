<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.A
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function publish(Post $post)
    {
        $this->posts()->save($post);
    }


    public function up($id)
    {
        User::query()->find($id)->score = $this->increment('score');
    }


    public function down($id)
    {
        if (User::query()->find($id)->score > 0) {
            User::query()->find($id)->score = $this->decrement('score');
        }
    }
}
