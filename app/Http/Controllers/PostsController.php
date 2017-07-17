<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function index() {
        // latest() zbiera od najnowszego posty jak Post::orderBy('created_at', 'desc')
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {

        // 'title' => 'required|max:10' - wymagane i max 10 znakow
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        //dd(request()->all());
        // request('title'); takes concrete attribute
        // request(['title', 'body']);

        // create a new post using the request data
        // save it to the database
        Post::create(request(['title', 'body']));


        // and then redirect to the home page
        return redirect('/');
    }
}
