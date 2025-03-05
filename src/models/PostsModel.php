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


    public function getSingle(int $id): PostEntity|false
    {
        $query = $this->db->prepare(
            'SELECT `posts`.`title`, `posts` . `id`, `posts` . `likes`, `posts` . `dislikes`, `posts` . `content`, `posts` . `date_posted` , `posts` . `time_posted`, `users` . `username` 
            FROM `posts` 
            JOIN `users` ON `users` . `id` = `posts` . `username_id`
            WHERE `posts`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function AddSinglePost(PostEntity $postEntity): bool
    {
        $query = $this->db->prepare(
            'INSERT INTO `posts` (`title`, `content`, `username_id`,  `date_posted`, `time_posted`) 
                    VALUES (:title, :content, :username_id, :date_posted, :time_posted);');
        return $query->execute([
            ':title'=>$postEntity->title,
            ':content'=>$postEntity->content,
            ':username_id' => $postEntity->username_id,
            ':date_posted' => $postEntity->date_posted,
            ':time_posted' => $postEntity->time_posted
        ]);
    }

    public function getDislikes(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT `posts` . `dislikes`
            FROM `posts`
            WHERE `posts`.`id` = :id;;');
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function sendLike(int $id): bool
    {
        $query = $this->db->prepare(
            'UPDATE `posts`
                    SET `likes` = `likes`+ 1
                    WHERE `id` = :id;');
        return $query->execute([':id' => $id]);
    }

}