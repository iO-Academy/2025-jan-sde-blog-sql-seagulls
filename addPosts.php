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
$postSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['username_id'])) {

    if (strlen($title) === 0 || strlen($title) > 30) {
        $_SESSION['titleError'] = 'Title cannot exceed 30 characters.';
        $dataIsValid = false;
    }

    if (strlen($content) < 50 || strlen($content) > 1000) {
        $_SESSION['contentError'] = 'Content must be between 50 and 1000 characters.';
        $dataIsValid = false;
    }

    if ($dataIsValid) {
        $postEntity = new PostEntity();
        $postEntity->title = $title;
        $postEntity->content = $content;
        $postEntity->username_id = $_SESSION['username_id'];
        $postEntity->date_posted = date('Y-m-d');
        $postEntity->time_posted = date('H:i:s');

        $PostsModel = new PostsModel($db);
        if ($PostsModel->AddSingle($postEntity)) {
            unset($_SESSION['titleError'], $_SESSION['contentError']);
            $postSubmitted = true;
        }
    }
}

        $titleError = $_SESSION['titleError'] ?? "";
        $contentError = $_SESSION['contentError'] ?? "";
        unset($_SESSION['titleError'],$_SESSION['contentError']);

?>

<?php include_once 'header.php'; ?>

<form method="post" class="container lg:w-3/4 mx-auto flex flex-col p-8 bg-slate-200">
    <?php if ($postSubmitted): ?>
    <h2 class="text-3x
    l text-green-600 mb-4 text-center">Post Submitted Successfully!</h2>
    <a href="addPosts.php" class="text-center text-blue-600 hover:underline">Create another post</a>
    <?php else: ?>
    <h2 class="text-3xl mb-4 text-center">Create New Post</h2>
    <div class="flex flex-col sm:flex-row mb-5 gap-5">
        <div class="w-full sm:w-2/3">
            <label class="mb-3 block" for="title">Title:</label>
            <input class="w-full px-3 py-2 text-lg" name="title" type="text" id="title" value="<?= htmlspecialchars($title); ?>" />
            <?php if (isset($titleError)): ?>
                <p class="text-red-500"><?= $titleError; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="content">Content:</label>
        <textarea class="w-full" name="content" id="content" rows="9"><?= htmlspecialchars($content); ?></textarea>
        <?php if (isset($contentError)): ?>
            <p class="text-red-500"><?= $contentError; ?></p>
        <?php endif; ?>
    </div>

    <button type="submit" class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm">
        Create Post
    </button>
    <?php endif; ?>
</form>
