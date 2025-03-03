<?php

declare(strict_types=1);
session_start();
ob_start();

require_once 'src/models/UsersModel.php';
require_once 'src/services/DatabaseConnectionService.php';

$db = DatabaseConnectionService::connect();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
    header('Location: index.php');
    exit();
}

?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="selection:bg-teal-200">
<nav class="flex justify-between items-center py-5 px-4 mb-10 border-b border-solid">
    <a href="src/models/index.php"><h1 class="text-5xl">Blog</h1></a>
    <div class="flex gap-5">
        <a href="addPost.php">Create Post</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>
<form method="post" class="container lg:w-1/4 mx-auto flex flex-col p-8 bg-slate-200">
    <h2 class="text-3xl mb-4 text-center">Login</h2>
    <div class="mb-5">
        <label class="mb-3 block" for="username">Username:</label>
        <input class="w-full px-3 py-2 text-lg" type="text" name="username" id="username" />
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="password">Password:</label>
        <input class="w-full px-3 py-2 text-lg" type="password" name="password" id="password" />
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $UsersModel = new UsersModel($db);
        $login = $UsersModel->login($username, $password);
        if ($login) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } else {
            echo '<p>Username and/or password are incorrect </p>';
        }
    }
    ?>
<!--    <label for="submit"></label>-->
    <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Login" />
</form>

</body>
</html>
