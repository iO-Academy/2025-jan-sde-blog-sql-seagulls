<?php
declare(strict_types=1);
session_start();

require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/PostsModel.php';
require_once 'src/entities/PostEntity.php';
require_once 'src/services/PostValidationService.php';

$db = DatabaseConnectionService::connect();

if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}
unset($_SESSION['titleError']);
unset($_SESSION['contentError']);

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['username_id'])) {
    $titleValid = PostValidationService::TitleValidation($title);
    if (!$titleValid) {
        $_SESSION['titleError'] = 'Title cannot exceed 30 characters.';
    }

    $contentValid = PostValidationService::ContentValidation($content);
    if (!$contentValid) {
        $_SESSION['contentError'] = 'Content must be between 50 and 1000 characters.';
    }

    if ($titleValid && $contentValid) {
        $PostModel = new PostsModel($db);
        PostValidationService::AddPostToDatabase($title, $content, $PostModel);
        $_SESSION['submissionValid'] = true;
    }
}

include_once 'header.php';?>

<form method="post" class="container lg:w-3/4 mx-auto flex flex-col p-8 bg-slate-200">
    <?php if (isset($_SESSION['submissionValid'])){ ?>
    <h2 class="text-3x
    l text-green-600 mb-4 text-center">Post Submitted Successfully!</h2>
    <a href="addPosts.php" class="text-center text-blue-600 hover:underline">Create another post</a>
    <?php unset($_SESSION['submissionValid']);
    }
    else {
    ?>
    <h2 class="text-3xl mb-4 text-center">Create New Post</h2>
    <div class="flex flex-col sm:flex-row mb-5 gap-5">
        <div class="w-full sm:w-2/3">
            <label class="mb-3 block" for="title">Title:</label>
            <input class="w-full px-3 py-2 text-lg" name="title" type="text" id="title" value="<?= htmlspecialchars($title); ?>"/>
            <?php if (isset($_SESSION['titleError'])): ?>
                <p class="text-red-500"><?=$_SESSION['titleError']; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="content">Content:</label>
        <textarea class="w-full" name="content" id="content" rows="9"><?= htmlspecialchars($content); ?></textarea>
        <?php if (isset($_SESSION['contentError'])): ?>
            <p class="text-red-500"><?= $_SESSION['contentError']; ?></p>
        <?php endif; ?>
    </div>

    <button type="submit" class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm">
        Create Post
    </button>
</form>
<?php }