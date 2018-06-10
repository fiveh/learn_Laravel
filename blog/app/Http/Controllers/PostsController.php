<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
//        $posts = Post::query()->latest()->filter(request(['month', 'year']))->get();
        $posts = Post::query()->latest()->paginate(3);

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


    public function store(Request $request)
    {
        $this->validate(request(),
            [
                'title' => 'required|min:2',
                'body' => 'required|min:4',
            ]);

        $post = new Post();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = \Auth::user()->id;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/');
            $image->move($location, $filename);

            $post->image = $filename;
        }

        $post->save();
//create new post by User class
//        auth()->user()->publish(
//            new Post(request(['title', 'body']))
//        );

//        And the redirect to the home page
        return redirect('/')->with('message', 'Good job bro');
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
                'featured_image' => 'image'
            ]);
        $post = Post::query()->find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if ($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/');
            $image->move($location, $filename);

            $oldFilename = $post->image;
            $post->image = $filename;
            Storage::delete($oldFilename);
        }

        $post->save();

        return redirect('/')->with('message', 'Update success!');
    }


    public function destroy($id)
    {
        $post = Post::query()->find($id);
        Storage::delete($post->image);
        $post->delete();

        return redirect()->home()->with('message', 'Delete success!');
    }


}


