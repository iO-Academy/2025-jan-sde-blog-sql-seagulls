<?php

declare(strict_types=1);

class PostDisplayService
{
    static public function displayAllPosts(array $posts): string
    {
        $output = '';

        foreach ($posts as $post) {
            $content = substr($post->content, 0,100);
            $output .= '<article class="p-8 border border-solid rounded-md">';
            $output .= "<span class='px-3 py-2 bg bg-slate-200 inline-block mb-4 rounded-sm'>CATEGORY HERE</span>";
            $output .= '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
            $output .= "<h2 class='text-4xl'>$post->title</h2>";
            $output .= "<span class='text-xl'>LIKES & DISLIKES HERE</span>";
            $output .= '</div>';
            $output .= "<p class='text-2xl mb-2'>$post->date_posted - $post->username</p>";
            $output .= "<p>$content...</p>";
            $output .= '</article>';
        }
        return $output;
    }
}