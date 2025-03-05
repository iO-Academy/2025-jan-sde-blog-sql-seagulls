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
        $query = $this->db->prepare('SELECT `username`, `password`, `id` FROM `users` WHERE `username` = :username AND `password`=:password;');
        $query->execute([':username' => $username, ':password' => $password]);
        return $query->fetch();
    }

    public function register(string $username, string $password, string $email): bool
    {
        $query = $this->db->prepare('INSERT INTO `users` (`username`,`password`, `email`) 
                                            VALUES (:username, :password, :email);');
        return $query->execute([':username' => $username, ':password' => $password, ':email' => $email]);
    }
}