<?php
declare(strict_types=1);
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/PostsModel.php';
require_once 'src/services/PostDisplayService.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$posts = $PostsModel->getAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="selection:bg-teal-200">
<section class="container lg:w-1/2 mx-auto flex flex-col gap-5">
    <?php
    echo PostDisplayService::displayAllPosts($posts);
    ?>
</section>
</body>
</html>