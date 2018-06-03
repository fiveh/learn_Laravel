<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest('updated_at')->get();
        return view('posts.index', compact('posts'));
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store()
    {
        $this->validate(request(),
            [
                'title' => 'required',
                'body' => 'required',
            ]);

//        Create new post using Class and request data
        Post::create(request(['title', 'body']));

//        And the redirect to the home page
        return redirect('/');
    }
}
