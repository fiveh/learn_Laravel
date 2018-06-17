<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Like;
use App\User;
use function Sodium\increment;
use Symfony\Component\Console\Helper\Table;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        $findLike = DB::table('likes')
            ->select('like')
            ->where('post_id', $post->id)
            ->where('user_id', \Auth::user()->id)
            ->first();

        $score = DB::table('users')->where('id', $post->user_id);

        if (!isset($findLike)) {
            $like = new Like();
            $like->user_id = \Auth::user()->id;
            $like->post_id = $post->id;
            $like->like = 1;
            $like->save();
            $post->like();
//up score
            $score->increment('score');

            return back();
        } else {
            DB::table('likes')
                ->select('like')
                ->where('post_id', $post->id)
                ->where('user_id', \Auth::user()->id)
                ->delete();
            $post->dislike();
//down score if > 0
            if ( $score->select('score')->first()->score > 0) {
                $score->decrement('score');
            }

            return back();
        }
    }
}
