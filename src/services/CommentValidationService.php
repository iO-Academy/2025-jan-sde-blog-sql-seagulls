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

    static public function AddCommentToDatabase(string $content, PostsModel $PostsModel, int $id): void
    {
        $commentEntity = new CommentEntity();
        $commentEntity->post_id = $id;
        $commentEntity->content = $content;
        $commentEntity->username_id = $_SESSION['username_id'];
        $commentEntity->date_posted = date('Y-m-d');
        $commentEntity->time_posted = date('H:i:s');
        $PostsModel->addComment($commentEntity);
    }
}


