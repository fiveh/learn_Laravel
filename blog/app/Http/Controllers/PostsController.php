<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
        $posts = Post::query()->latest()->filter(request(['month', 'year']))->get();

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

//        create new post by User class
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

//        And the redirect to the home page
        return redirect('/');
    }

    public function dashboard()
    {
        $posts = Post::query()->get();

        return view('posts.dashboard', compact('posts'));
    }


    public function edit($id)
    {
        $post = Post::query()->find($id);

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, $id)
    {

        $this->validate(request(),
            [
                'title' => 'required',
                'body' => 'required',
            ]);
        $post = Post::query()->find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();

//        \Session::flash('message', 'Success!!!');

        return redirect('/')->with('message', 'Update success!');
    }


    public function destroy($id)
    {
            $post = Post::query()->find($id);
//            dd($id);
            $post->delete();

            return redirect('/')->with('message', 'Delete success!');
    }
    

}


