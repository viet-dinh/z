<?php

namespace App\Http\Controllers\Api;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReplyResource;
use Illuminate\Auth\Access\AuthorizationException;

class ReplyController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1024',
        ]);

        $reply = Reply::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'comment_id' => $commentId,
        ]);

        $reply->user = Auth::user();

        return ReplyResource::make($reply);
    }

    public function destroy($id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            return response()->json([
                'message' => 'Reply not found'
            ], 404);
        }

        if (Auth::user()->cannot('delete', $reply)) {
            throw new AuthorizationException('You do not have permission to delete this reply.');
        }

        return $reply->delete();
    }
}
