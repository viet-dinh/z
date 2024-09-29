<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class CommentController extends Controller
{
    // Add a new comment
    public function store(Request $request, $storyId)
    {
        $request->validate([
            'content' => 'required|string|max:1024',
            'chapter_order' => 'nullable|integer',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'story_id' => $storyId,
            'chapter_order' => $request->chapter_order,
        ]);

        $comment->user = new UserResource(Auth::user());

        return response()->json($comment, 201);
    }

    public function index($storyId)
    {
        $comments = Comment::with(['user:id,name', 'replies.user', 'reactions', 'replies.reactions'])
            ->where('story_id', $storyId)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return response()->json($comments, 200);
    }
}
