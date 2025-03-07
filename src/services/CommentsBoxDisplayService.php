<?php

declare(strict_types=1);

require_once 'src/services/CommentValidationService.php';
require_once 'src/entities/CommentEntity.php';

class CommentsBoxDisplayService
{
    static public function commentBoxDisplay(string $content, ?bool $contentValid, bool $showSuccessMessage): string
    {
        $output = '<section class="container md:w-1/2 mx-auto mt-5">';
        if (!$showSuccessMessage) {
            $output .= '<form method="post" class="p-8 border border-solid rounded-md bg-slate-200">';
            $output .= '<div class="mb-5">';
            $output .= '<label class="mb-3 block" for="content">Comment:</label>';
            $output .= "<textarea class='w-full' id='content' rows='5' name='content'>";
            $output .= "</textarea>";
            if ($contentValid === false) {
                $output .= '<p class="text-red-500">Content must be between 10 and 200 characters.</p>';
            }
            $output .= '</div>';
            $output .= '<input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Post Comment"/>';
            $output .= '</form>';
            return $output;
        } else {
            $output .= '<h2 class="text-3xl text-green-600 mb-4 text-center">Comment Submitted Successfully!</h2>';
        }
        $output .= '</section>';
        return $output;
    }
}