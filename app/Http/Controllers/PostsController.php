<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Post;
use App\Repositories\Posts;

class PostsController extends Controller
{

    public function __construct()
    {
        // all users can have access to store() method except index() and show()
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Posts $posts) {

        // Dependency Injection, Laravel uses reflection
        $posts = $posts->all();

        /*
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();
        */
        // latest() zbiera od najnowszego posty jak Post::orderBy('created_at', 'desc')
        //$posts = Post::latest();

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
        //Post::create(request(['title', 'body', 'user_id']));

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        session()->flash('message', 'Your post has now been published.');

        // and then redirect to the home page
        return redirect('/');
    }
}
