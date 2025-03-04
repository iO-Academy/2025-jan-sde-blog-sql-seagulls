<?php

declare(strict_types=1);

require_once 'src/entities/PostEntity.php';

class PostsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $query = $this->db->prepare(
            'SELECT `posts`.`title`, `posts` . `id`, `posts` . `content`, `posts` . `date_posted` , `posts` . `time_posted`, `users` . `username` 
            FROM `posts` 
            JOIN `users` ON `users` . `id` = `posts` . `username_id`;');
        $query->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function AddSingle(PostEntity $postEntity): bool
    {
        $query = $this->db->prepare(
            'INSERT INTO `posts` (`title`, `content`, `username_id`) VALUES (:title, :content, :username_id);');
            return $query->execute([':title'=>$postEntity->title, ':content'=>$postEntity->content, ':username_id' => $postEntity->username_id]);
    }
}