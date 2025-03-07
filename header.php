<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="selection:bg-teal-200">
<nav class="flex justify-between items-center py-5 px-4 mb-10 border-b border-solid">
    <a href="index.php"><h1 class="text-5xl">Blog</h1></a>
    <div class="flex gap-5">
        <?php
        if (!isset($_SESSION['loggedIn'])) {
            ?><a href="login.php">Login</a><?php
        }?>
        <a href="logout.php">Log out</a>
        <?php
        if (!isset($_SESSION['loggedIn'])) {
        ?><a href="userRegistration.php">Register</a><?php
        }?>
        <a href="addPosts.php">Add Post</a>
    </div>
</nav>