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

    static public function displaySingle(PostEntity $post, array $comments): string
    {
        if ($post->username == ""){
            $post->username = "Anonymous";
        }
//        if ($comment->id == ""){
//            $comment->id = 0;
//        }


        $output = '<section class="container md:w-1/2 mx-auto">';
        $output .= '<article class="p-8 border border-solid rounded-md">';
        $output .= '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
        $output .= "<h2 class='text-4xl'>$post->title</h2>";
        $output .= '</div>';
        $output .=  "<p class='text-2xl mb-10'>$post->date_posted - $post->username</p>";
        $output .=  "<p>$post->content</p>";
        $output .=  '<div class="flex justify-center">';
        $output .=  '<div class="mb-5">';
        $output .= '<a class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" href="index.php">View all posts</a>';
        $output .= ' </article>';
        $output .= '</section>';
        foreach ($comments as $comment) {
            $output .=  '<section class="container md:w-1/2 mx-auto mt-5 mb-10">';
            $output .=  '<div class="p-8 border border-solid rounded-md bg-slate-200">';
            $output .=  "<div class='text-2xl mb-3'>$comment->username - $comment->date_posted</div>";
            $output .=  "<p>$comment->content</p>";
            $output .=  '</div>';
        $output .=  '</section>';}
        return $output;

    }
}
