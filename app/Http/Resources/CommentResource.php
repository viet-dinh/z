<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'canDelete' => Auth::user()?->isAdmin() || $this->user_id === Auth::id(),
            'replies' => ReplyResource::collection($this->whenLoaded('replies')),
        ]);
    }
}
