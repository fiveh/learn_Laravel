<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Like;
use function Sodium\increment;
use Symfony\Component\Console\Helper\Table;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        $sel = DB::table('likes')
            ->select('like')
            ->where('post_id', $post->id)
            ->where('user_id', \Auth::user()->id)
            ->get();

        $newsel = $sel->toArray();
        if (!isset($newsel[0])) {
            $like = new Like();

            $like->user_id = \Auth::user()->id;
            $like->post_id = $post->id;
            $like->like = 1;
            $like->save();
            $post->like();

            return back();
        } else {
            DB::table('likes')
                ->select('like')
                ->where('post_id', $post->id)
                ->where('user_id', \Auth::user()->id)
                ->delete();

            $post->dislike();

            return back()->with('message', 'Dislike ');
        }
    }
}
