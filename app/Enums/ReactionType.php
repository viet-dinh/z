<?php

namespace App\Enums;

enum ReactionType: int
{
    case LIKE = 0;
    case LOVE = 1;
    case LAUGH = 2;
    case WOW = 3;
    case SAD = 4;
    case ANGRY = 5;

    public function getEmoji(): string
    {
        return match ($this) {
            self::LIKE => "👍",
            self::LOVE => "❤️",
            self::LAUGH => "😂",
            self::WOW => "😮",
            self::SAD => "😢",
            self::ANGRY => "😡",
        };
    }
}