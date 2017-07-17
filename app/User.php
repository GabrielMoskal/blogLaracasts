<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post) {
        $this->posts()->save($post);
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    // https://laravel.com/docs/5.4/eloquent-mutators#defining-a-mutator
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
}
