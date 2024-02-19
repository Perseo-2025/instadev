<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        //Si el usuario es el mismo que publico el post
        return $user->id === $post->user_id;
        $post->delete();

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
