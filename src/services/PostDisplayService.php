<?php

declare(strict_types=1);

class PostDisplayService
{
    static public function displayAllPosts(array $posts): string
    {
        if ($posts==[]){
            return "<p class='text-2xl mb-2'>No posts found</p>";
        }
            $output = '';

            foreach ($posts as $post) {
                if (strlen($post->content) > 100){
                    $content = substr($post->content, 0,100);
                    $content .= '...';
                } else {
                    $content = $post->content;
                }
                $output .= '<article class="p-8 border border-solid rounded-md">';
                $output .= '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
                $output .= "<h2 class='text-4xl'>$post->title</h2>";
                $output .= '</div>';
                $output .= "<p class='text-2xl mb-2'>$post->date_posted - $post->username</p>";
                $output .= "<p>$content</p>";
                $output .= '</article>';
            }

        return $output;
    }
}