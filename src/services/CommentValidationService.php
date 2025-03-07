<?php

declare(strict_types=1);
class CommentValidationService
{
    static public function ContentValidation(string $content): bool
    {
        if (strlen($content) < 10 || strlen($content) > 200) {
            return false;
        }
        return true;
    }

    static public function ContentSpecialCharCheck(string $content): string
    {
        return htmlspecialchars($content);
    }
}