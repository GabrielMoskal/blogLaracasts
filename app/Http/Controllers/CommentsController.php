<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Post $post) {
        /*
        Comment::create([
            'body' => request('body'),
            'post_id' => $post->id
        ]);
        */

        $this->validate(request(), ['body' => 'required|min:2']);
        $post->addComment(request('body'));

        // returns to a previous page
        return back();
    }
}
