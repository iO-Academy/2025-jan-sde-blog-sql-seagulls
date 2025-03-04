<?php
declare(strict_types=1);
Class UsersModel
{

    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function login(string $username, string $password): array|false
    {
        $query = $this->db->prepare('SELECT `username`, `password` FROM `users` WHERE `username` = :username AND `password`=:password;');
        $query->execute([':username' => $username, ':password' => $password]);
        return $query->fetch();
    }
}