<?php

namespace App\Http\Controllers\Api;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    // Add a reply to a comment
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $reply = Reply::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'comment_id' => $commentId,
        ]);

        return response()->json($reply, 201);
    }
}
