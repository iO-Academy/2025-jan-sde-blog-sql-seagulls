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

    public function getAll(string $postOrder): array
    {
        $order_by = "";
        if ($postOrder == 'newest'){
            $order_by = 'ORDER BY `date_posted` DESC';
        } elseif ($postOrder == 'oldest') {
            $order_by = 'ORDER BY `date_posted` ASC';
        } elseif ($postOrder == 'most_liked') {
            $order_by = 'ORDER BY `likes` DESC';
        } elseif ($postOrder == 'most_disliked') {
            $order_by = 'ORDER BY `dislikes` DESC';
        }


        $query = $this->db->prepare(
            "SELECT `posts`.`title`, 
                        `posts`.`id`, 
                        `posts`.`content`, 
                        `posts`.`date_posted` , 
                        `posts`.`time_posted`, 
                        `users`.`username`, 
                        `posts`.`likes`, 
                        `posts`.`dislikes` 
                FROM `posts` 
                JOIN `users` ON `users` . `id` = `posts` . `username_id`
                $order_by;");

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

    public function addComment(CommentEntity $commentEntity): bool
    {
        $query = $this->db->prepare(
            'INSERT INTO `comments` (`content`,`username_id`, `post_id`, `date_posted`, `time_posted`) VALUES (:content, :username_id, :post_id, :date_posted, :time_posted);');
        return $query->execute([':content' => $commentEntity->content, ':username_id' => $commentEntity->username_id, ':post_id' => $commentEntity->post_id, ':date_posted' => $commentEntity->date_posted, ':time_posted' => $commentEntity->time_posted]);
    }

    public function getComments(int $post_id): array
    {
        $query = $this->db->prepare(
            'SELECT `comments`.`content`, `comments`.`username_id`,`comments`.`post_id`,`comments`.`date_posted`,`comments`.`time_posted`, `users` . `username` 
             FROM `comments`
             JOIN `users` ON `users` . `id` = `comments` . `username_id`
             JOIN `posts` ON `posts` . `id` = `comments` . `post_id`
             WHERE `comments`.`post_id` = :post_id;');
        $query->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class);
        $query->execute([':post_id' => $post_id]);
        return $query->fetchAll();
    }
}