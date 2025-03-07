<?php

declare(strict_types=1);

class LikesModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function trackActivity(int $postsId, int $usersId): array
    {
        $query = $this->db->prepare(
            'SELECT `posts_id`, `users_id`
        FROM `likes_dislikes`
        WHERE `posts_id` = :postsId AND `users_id` = :usersId'
        );
        $query->execute([
            ':postsId' => $postsId,
            ':usersId' => $usersId
        ]);

        $result = $query->fetch();

        if (!$result) {
            $output = [];
            return $output;
        } else {
            return $result;
        }
    }

        public function addDislike(int $postsId, int $usersId, array $dislikeCheck): void
        {
        if (!$dislikeCheck) {
            $query = $this->db->prepare('INSERT INTO `likes_dislikes` (`posts_id`, `users_id`)
                                                VALUES (:postsId, :usersId);');
            $query->execute([
                    ':postsId' => $postsId,
                    ':usersId' => $usersId
                    ]);

            $query2 = $this->db->prepare(
            'UPDATE `posts`
                    SET `dislikes` = `dislikes`+ 1
                    WHERE `id` = :id;');
            $query2->execute([':id' => $postsId]);
        }
    }

    public function addLike(int $postsId, int $usersId, array $likeCheck): void
    {
        if (!$likeCheck) {
            $query = $this->db->prepare('INSERT INTO `likes_dislikes` (`posts_id`, `users_id`)
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