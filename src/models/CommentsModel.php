<?php

declare(strict_types=1);

require_once 'src/entities/CommentEntity.php';

class CommentsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function addComment(CommentEntity $commentEntity): bool
    {
        $query = $this->db->prepare(
            'INSERT INTO `comments` (`content`, `username_id`, `post_id`, `date_posted`, `time_posted`) VALUES (:content, :username_id, :post_id, :date_posted, :time_posted);');
        return $query->execute([
            ':content' => $commentEntity->content,
            ':username_id' => $commentEntity->username_id,
            ':post_id' => $commentEntity->post_id,
            ':date_posted' => $commentEntity->date_posted,
            ':time_posted' => $commentEntity->time_posted]);
    }
    static public function AddCommentToDatabase(int $id, string $content): CommentEntity
    {
        $commentEntity = new CommentEntity();
        $commentEntity->post_id = $id;
        $commentEntity->content = $content;
        $commentEntity->username_id = $_SESSION['username_id'];
        $commentEntity->date_posted = date('Y-m-d');
        $commentEntity->time_posted = date('H:i:s');
        return $commentEntity;
    }
}