<?php
declare(strict_types=1);
session_start();

require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/PostsModel.php';
require_once 'src/entities/PostEntity.php';

$db = DatabaseConnectionService::connect();

if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}
if (isset($_POST['submit']) && isset($_SESSION['username_id'])) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    var_dump($_SESSION, $title, $content);

    $postEntity = new PostEntity();
    $postEntity->title = $title;
    $postEntity->content = $content;
    $postEntity->username_id = $username_id;

    $PostsModel = new PostsModel($db);
    $AddSingle = $PostsModel->AddSingle($postEntity);

    if ($AddSingle) {
        header("Location: addPosts.php");
        exit();
    }
}
    include_once 'header.php';
?>
<form method="post" class="container lg:w-3/4 mx-auto flex flex-col p-8 bg-slate-200">
    <h2 class="text-3xl mb-4 text-center">Create new post</h2>

    <div class="flex flex-col sm:flex-row mb-5 gap-5">
        <div class="w-full sm:w-2/3">
            <label class="mb-3 block" for="title">Title:</label>
            <input class="w-full px-3 py-2 text-lg" name="title" type="text" id="title" />
        </div>
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="content">Content:</label>
        <textarea class="w-full" name="content" id="content" rows="9"></textarea>
    </div>

    <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Create Post" />
</form>