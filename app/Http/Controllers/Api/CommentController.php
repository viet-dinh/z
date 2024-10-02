<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Access\AuthorizationException;

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

        return new CommentResource($comment);
    }

    public function index($storyId)
    {
        $comments = Comment::with(['user:id,name', 'replies.user:id,name', 'reactions', 'replies.reactions'])
            ->where('story_id', $storyId)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return CommentResource::collection($comments);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Story not found'
            ], 404);
        }

        if (Auth::user()->cannot('delete', $comment)) {
            throw new AuthorizationException('You do not have permission to delete this comment.');
        }

        return $comment->delete();
    }
}
