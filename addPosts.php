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

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$titleError = "";
$contentError = "";
$dataIsValid = true;

if (strlen($title) > 30) {
    $_SESSION['titleError'] = '<strong>Title cannot exceed 30 characters.</strong>';
    $dataIsValid = false;
}

if (strlen($content) < 50 || strlen($content) > 1000) {
    $_SESSION['contentError'] = '<strong>Content has to be between 50 to 1000 characters.</strong>';
    $dataIsValid = false;
}


if (isset($_POST['submit']) && isset($_SESSION['username_id']) && $dataIsValid) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $postEntity = new PostEntity();
    $postEntity->title = $title;
    $postEntity->content = $content;
    $postEntity->username_id = $_SESSION['username_id'];
    $postEntity->date_posted = date('Y-m-d');
    $postEntity->time_posted = date('H:i:s');


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
            <input class="w-full px-3 py-2 text-lg" name="title" onchange="" type="text" id="title" />
            <?php if (isset($_SESSION['titleError'])) {
                echo $_SESSION['titleError'];
            }
            ?>
        </div>
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="content">Content:</label>
        <textarea class="w-full" name="content" id="content" rows="9"></textarea>
        <?php if (isset($_SESSION['contentError'])) {
            echo $_SESSION['contentError'];
        }
        ?>
    </div>

    <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Create Post" />
</form>