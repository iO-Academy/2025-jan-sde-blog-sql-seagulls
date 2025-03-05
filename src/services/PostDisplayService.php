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
                $output .= '<div class="flex justify-center">';
                $output .= "<a class='px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm' href='singlePost.php?id={$post->id}'>View post</a>";
                $output .= '</div>';
                $output .= '</article>';
            }

        return $output;
    }

    static public function displaySingle(PostEntity $post): string
    {
        if ($post->username == ""){
            $post->username = "Anonymous";
        }
        $output = '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
        $output .= "<h2 class='text-4xl'>$post->title</h2>";
        $output .= "<span class='text-xl''>$post->likes likes - $post->dislikes dislikes</span>";
        $output .= '</div>';
        $output .=  "<p class='text-2xl mb-10'>$post->date_posted - $post->username</p>";
        $output .=  "<p>$post->content</p>";
        $output .= '<div class="flex justify-center gap-5">';
        $output .= "<a class='px-3 py-2 mt-4 text-lg bg-green-300 hover:bg-green-400 hover:text-white transition inline-block rounded-sm' href='likes.php?id=$post->id'>Like</a>";
        $output .= "<a class='px-3 py-2 mt-4 text-lg bg-red-300 hover:bg-red-400 hover:text-white transition inline-block rounded-sm' href='dislikes.php?id=$post->id'>Dislike</a>";
        $output .= '</div>';
        $output .= '<div class="flex justify-center">';
        $output .= '<a class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" href="index.php">View all posts</a>';
        $output .= '</div>';
        return $output;

    }

}