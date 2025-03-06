<?php
declare(strict_types=1);
session_start();
require_once 'src/services/PostDisplayService.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/entities/PostEntity.php';
require_once 'src/models/PostsModel.php';
require_once 'src/entities/CommentEntity.php';
require_once 'src/services/CommentValidationService.php';

include_once 'header.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);

$post = $PostsModel->getSingle((int)$_GET['id']);

if (!$post) {
    header('Location: index.php');
}

unset($_SESSION['contentError']);
$content = $_POST['content'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['username_id'])) {
    $contentValid = CommentValidationService::ContentValidation($content);
    if (!$contentValid) {
        $_SESSION['contentError'] = 'Content must be between 10 and 200 characters.';
    }

    if ($contentValid) {
        $PostModel = new PostsModel($db);
        CommentValidationService::AddCommentToDatabase($content, $PostModel,(int)$_GET['id'] );
        $_SESSION['hideComments'] = true;
    }
 }
$comment = $PostsModel->getComments((int)$_GET['id']);
echo PostDisplayService::displaySingle($post, $comment);

if (!isset($_SESSION['loggedIn'])) {
    unset($_SESSION['hideComments']);
    exit();
}
?>
<section class="container md:w-1/2 mx-auto mt-5">
    <form method="post" class="p-8 border border-solid rounded-md bg-slate-200">
        <?php if (isset($_SESSION['hideComments'])){ ?>
        <h2 class="text-3x
    l text-green-600 mb-4 text-center">Comment Submitted Successfully!</h2>
            <?php unset($_SESSION['hideComments']);
        }
        else {
        ?>
        <div class="mb-5">
            <label class="mb-3 block" for="content">Comment:</label>
            <textarea class="w-full" id="content" rows="5" name="content"><?= htmlspecialchars($content); ?></textarea>
        </div>

        <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" value="Post Comment"/>
        <?php if (isset($_SESSION['contentError'])): ?>
            <p class="text-red-500"><?=$_SESSION['contentError']; ?></p>
        <?php endif; ?>
    </form>
</section>
        <?php }