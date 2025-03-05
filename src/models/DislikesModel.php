<?php


declare(strict_types=1);

class DislikesModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function trackDislikes(int $postsId, int $usersId): void
    {
        $query = $this->db->prepare(
            'SELECT `posts_id`, `users_id`
            FROM `dislikes`
            WHERE `posts_id` = :postsId AND `users_id` = :usersId');
        $query->execute([
            ':postsId' => $postsId,
            ':usersId' => $usersId
        ]);
        $check = $query->fetch();

        if ($check != []) {
            header("Location: singlePost.php?id=$postsId");
        } else {
            $query = $this->db->prepare('INSERT INTO `dislikes` (`posts_id`, `users_id`)
                                                VALUES (:postsId, :usersId);');
            $query->execute([
                ':postsId' => $postsId,
                ':usersId' => $usersId
            ]);
        }
    }

}