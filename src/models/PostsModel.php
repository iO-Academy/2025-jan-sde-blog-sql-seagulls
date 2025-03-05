<?php

declare(strict_types=1);

require_once 'src/entities/PostEntity.php';
require_once 'src/entities/CommentEntity.php';

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
            'SELECT `posts`.`title`, `posts` . `id`, `posts` . `content`, `posts` . `date_posted` , `posts` . `time_posted`, `users` . `username` 
            FROM `posts` 
            JOIN `users` ON `users` . `id` = `posts` . `username_id`
            WHERE `posts`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function addComment (CommentEntity $commentEntity): bool
    {
        $query = $this->db->prepare(
            'INSERT INTO `comments` (`content`,`username_id`, `post_id`, `date_posted`, `time_posted`) VALUES (:content, :username_id, :post_id, :date_posted, :time_posted);');
        return $query->execute([':content'=>$commentEntity->content, ':username_id'=>$commentEntity->username_id, ':post_id'=>$commentEntity->post_id, ':date_posted'=>$commentEntity->date_posted, ':time_posted'=>$commentEntity->time_posted]);
    }

    public function getComment(int $id): CommentEntity|false
    {
        $query = $this->db->prepare(
            'SELECT `comments`.`content`, `comments`.`username_id`,`comments`.`post_id`,`comments`.`date_posted`,`comments`.`time_posted`
             FROM `comments`
             JOIN `users` ON `users` . `id` = `comments` . `username_id`
             JOIN `posts` ON `posts` . `id` = `comments` . `post_id`
             WHERE `comments`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }
}