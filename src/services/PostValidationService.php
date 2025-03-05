<?php

declare(strict_types=1);

class PostValidationService
{
    static public function TitleValidation(string $title): bool
    {
        if (strlen($title) === 0 || strlen($title) > 30) {
            $_SESSION['titleError'] = 'Title cannot exceed 30 characters.';
            return false;
        }
        unset($_SESSION['titleError']);
        return true;
    }

    static public function ContentValidation(string $content): bool
    {
        if (strlen($content) < 50 || strlen($content) > 1000) {
            $_SESSION['contentError'] = 'Content must be between 50 and 1000 characters.';
            return false;
        }
        unset($_SESSION['contentError']);
        return true;
    }

    static public function AddPostToDatabase(string $title, string $content, PDO $db): void
    {
            $postEntity = new PostEntity();
            $postEntity->title = $title;
            $postEntity->content = $content;
            $postEntity->username_id = $_SESSION['username_id'];
            $postEntity->date_posted = date('Y-m-d');
            $postEntity->time_posted = date('H:i:s');

            $PostsModel = new PostsModel($db);
            if ($PostsModel->AddSingle($postEntity)) {
                unset($_SESSION['titleError'], $_SESSION['contentError']);
            }
        }
}

