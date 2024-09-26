<?php

namespace App\Http\Controllers\Api;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReactionController extends Controller
{
    public function store(Request $request, $reactableType, $reactableId)
    {
        $request->validate([
            'type' => 'required|integer|between:0,255', // Enum constraint for reactions
        ]);

        if (!in_array($reactableType, Reaction::REACTABLE_TYPES)) {
            return response()->json(['message' => 'Reactable type not found'], 404);
        }

        // Find the existing reaction by the user
        $existingReaction = Reaction::where('reactable_id', $reactableId)
            ->where('reactable_type', $reactableType)
            ->where('user_id', Auth::id())
            ->where('type', $request->type)
            ->first();

        if ($existingReaction) {
            $existingReaction->delete();
            return response()->json(0, 200);
        } else {
            $reaction = Reaction::create([
                'reactable_id' => $reactableId,
                'reactable_type' => $reactableType,
                'user_id' => Auth::id(),
                'type' => $request->type,
            ]);

            return response()->json($reaction, 201); // Return newly created reaction
        }
    }
}
