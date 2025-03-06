<?php

declare(strict_types=1);

class LikesModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function trackLikes(int $postsId, int $usersId ): void
    {
        $query = $this->db->prepare(
    'SELECT `posts_id`, `users_id`
            FROM `likes`
            WHERE `posts_id` = :postsId AND `users_id` = :usersId');
        $query->execute([
            ':postsId' => $postsId,
            ':usersId' => $usersId
        ]);
        $check = $query->fetch();

        if ($check != []) {
            header("Location: singlePost.php?id=$postsId");
        } else{
            $query = $this->db->prepare('INSERT INTO `likes` (`posts_id`, `users_id`)
                                                VALUES (:postsId, :usersId);');
            $query->execute([
                    ':postsId' => $postsId,
                    ':usersId' => $usersId
                    ]);

            $query2 = $this->db->prepare(
            'UPDATE `posts`
                    SET `likes` = `likes`+ 1
                    WHERE `id` = :id;');
            $query2->execute([':id' => $postsId]);
        }
    }
}