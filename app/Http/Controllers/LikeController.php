<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $rq, Post $post)
    {
       $post->likes()->create([
            'user_id' => $rq->user()->id

       ]);
 
       return back();
    }

    public function destroy(Request $rq, Post $post)
    {
        $rq->user()->likes()->where('post_id', $post->id)->delete();
        
        return back();
    }
    
}
