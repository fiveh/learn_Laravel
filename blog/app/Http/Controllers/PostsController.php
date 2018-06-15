<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function Sodium\increment;
use Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
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
        $user = \Auth::user();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $user->id;
        $post->likescount = 0;
//        score
        $user->up($user->id);
        $user->up($user->id);


        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/');
            $image->move($location, $filename);

            $post->image = $filename;
        }
        $post->save();

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

        if ($request->hasFile('featured_image')) {
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
//  del all comments
        $post = Post::find($id);
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
//        score
        $user = \Auth::user();
        $user->down($user->id);
        $user->down($user->id);

        return back()->with('message', 'Delete success!');
    }


}


