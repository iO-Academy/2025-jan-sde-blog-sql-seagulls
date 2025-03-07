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

    public function getAll(string $postOrder): array
    {
        if ($postOrder == 'newest'){
            $query = $this->db->prepare(
         'SELECT `posts`.`title`, 
                        `posts`.`id`, 
                        `posts`.`content`, 
                        `posts`.`date_posted` , 
                        `posts`.`time_posted`, 
                        `users`.`username`, 
                        `posts`.`likes`, 
                        `posts`.`dislikes` 
                FROM `posts` 
                JOIN `users` ON `users` . `id` = `posts` . `username_id`
                ORDER BY `date_posted` DESC;');
        } elseif ($postOrder == 'oldest') {
            $query = $this->db->prepare(
         'SELECT `posts`.`title`, 
                        `posts`.`id`, 
                        `posts`.`content`, 
                        `posts`.`date_posted` , 
                        `posts`.`time_posted`, 
                        `users`.`username`, 
                        `posts`.`likes`, 
                        `posts`.`dislikes` 
                FROM `posts` 
                JOIN `users` ON `users` . `id` = `posts` . `username_id`
                ORDER BY `date_posted` ASC;');
        } elseif ($postOrder == 'most_liked') {
            $query = $this->db->prepare(
         'SELECT `posts`.`title`, 
                        `posts`.`id`, 
                        `posts`.`content`, 
                        `posts`.`date_posted` , 
                        `posts`.`time_posted`, 
                        `users`.`username`, 
                        `posts`.`likes`, 
                        `posts`.`dislikes` 
                FROM `posts` 
                JOIN `users` ON `users` . `id` = `posts` . `username_id`
                ORDER BY `likes` DESC;');
        } elseif ($postOrder == 'most_disliked') {
            $query = $this->db->prepare(
         'SELECT `posts`.`title`, 
                        `posts`.`id`, 
                        `posts`.`content`, 
                        `posts`.`date_posted` , 
                        `posts`.`time_posted`, 
                        `users`.`username`, 
                        `posts`.`likes`, 
                        `posts`.`dislikes`  
                FROM `posts` 
                JOIN `users` ON `users` . `id` = `posts` . `username_id`
                ORDER BY `dislikes` DESC;');
        }

        $query->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);
        $query->execute();
        return $query->fetchAll();
    }


    public function getSingle(int $id): PostEntity|false
    {
        $query = $this->db->prepare(
            'SELECT `posts`.`title`, `posts`.`id`, `posts`.`likes`, `posts`.`dislikes`, `posts`.`content`, `posts`.`date_posted`, `posts`.`time_posted`, `users`.`username` 
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

}