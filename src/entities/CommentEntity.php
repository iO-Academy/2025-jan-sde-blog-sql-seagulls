<?php

declare(strict_types=1);

class CommentEntity
{
    public int $id;
    public int $username_id;
    public int $post_id;
    public string $content;
    public string $date_posted;
    public string $time_posted;
}