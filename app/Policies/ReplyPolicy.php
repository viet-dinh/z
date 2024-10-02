<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;

class ReplyPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Reply $reply)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $reply->user_id;
    }
}
