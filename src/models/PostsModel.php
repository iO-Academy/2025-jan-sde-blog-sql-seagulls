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
            'SELECT `posts`.`title`, `posts` . `id`, `posts` . `content`, `posts` . `date_posted` , `posts` . `time_posted`, `users` . `username` 
            FROM `posts` 
            JOIN `users` ON `users` . `id` = `posts` . `username_id`
            WHERE `posts`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

}