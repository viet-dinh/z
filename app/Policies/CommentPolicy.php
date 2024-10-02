<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function __construct()
    {
        //
    }

    public function delete(User $user, Comment $comment)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $comment->user_id;
    }
}
