<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // Add a new comment
    public function store(Request $request, $storyId)
    {
        $request->validate([
            'content' => 'required|string',
            'chapter_order' => 'nullable|integer',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'story_id' => $storyId,
            'chapter_order' => $request->chapter_order,
        ]);

        return response()->json($comment, 201);
    }

    // Get all comments for a specific story
    public function index($storyId)
    {
        $comments = Comment::with(['user', 'replies.user', 'reactions'])->where('story_id', $storyId)->get();

        return response()->json([
            'message' => 'Comments retrieved successfully',
            'data' => $comments
        ], 200);
    }
}
