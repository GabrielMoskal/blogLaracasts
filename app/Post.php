<?php

namespace App;
use Carbon\Carbon;

class Post extends Model
{
    public function comments() {
        // Comment::class returns string representation of class path
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function addComment($body) {
        /*
        Comment::create([
            'body' => $body,
            'post_id' => $this->id
        ]);
        */
        // $this->comments returns collection of all comments associated with the post,
        // $this->comments()->create() return this chaining-able object
        $this->comments()->create(compact('body'));
    }

    public function scopeFilter($query, $filters) {
        if ($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year']) {
            $query->whereMonth('created_at', $year);
        }
    }

    // we set fields with we are OK to be mass assignment like in PostsController::store()
    // but this can get a little annoying, so we have a couple choices
    //protected $fillable = ['title', 'body'];

    // option 1: it specifies the fields we do not want to allos
    //protected $guarded = ['user_id'];

    // third option: create a parent class, so we won't have to do this in every class

}
