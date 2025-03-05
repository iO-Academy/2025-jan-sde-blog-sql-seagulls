<?php

declare(strict_types=1);

class PostValidationService
{
    static public function TitleValidation(string $title): bool
    {
        if (strlen($title) === 0 || strlen($title) > 30) {
            return false;
        }
        return true;
    }

    static public function ContentValidation(string $content): bool
    {
        if (strlen($content) < 50 || strlen($content) > 1000) {
            return false;
        }
        return true;
    }

    static public function AddPostToDatabase(string $title, string $content, PostsModel $PostsModel): void
    {
            $postEntity = new PostEntity();
            $postEntity->title = $title;
            $postEntity->content = $content;
            $postEntity->username_id = $_SESSION['username_id'];
            $postEntity->date_posted = date('Y-m-d');
            $postEntity->time_posted = date('H:i:s');

            if ($PostsModel->AddSinglePost($postEntity)) {
                unset($_SESSION['titleError'], $_SESSION['contentError']);
            }
        }
}

