<?php
declare(strict_types=1);
session_start();
require_once 'src/services/PostDisplayService.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/entities/PostEntity.php';
require_once 'src/models/PostsModel.php';
require_once 'src/entities/CommentEntity.php';
require_once 'src/services/CommentValidationService.php';
require_once 'src/models/CommentsModel.php';

include_once 'header.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$hideComments = false;

$contentError = "";
$content = $_POST['content'] ?? '';
$id = (int)$_GET['id'];

$post = $PostsModel->getSingle($id);

if (!$post) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $contentValid = CommentValidationService::ContentValidation($content);
    if (!$contentValid) {
        $contentError = 'Content must be between 10 and 200 characters.';
    }

    if ($contentValid) {
        $CommentModel = new CommentsModel($db);
        $commentEntity = CommentsModel::AddCommentToDatabase($id, $content);
        $CommentModel->addComment($commentEntity);
        $hideComments = true;
        $content = '';
    }
 }

$comment = $PostsModel->getComments($id);
echo PostDisplayService::displaySingle($post, $comment);

if (!isset($_SESSION['loggedIn'])) {
    exit();
}
?>
<section class="container md:w-1/2 mx-auto mt-5">
    <form method="post" class="p-8 border border-solid rounded-md bg-slate-200">
        <?php if ($hideComments){?>
        <h2 class="text-3xl text-green-600 mb-4 text-center">Comment Submitted Successfully!</h2>
        <?php } else {
        ?>
        <div class="mb-5">
            <label class="mb-3 block" for="content">Comment:</label>
            <textarea class="w-full" id="content" rows="5" name="content"><?= htmlspecialchars($content); ?></textarea>
        </div>

        <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Post Comment"/>
        <?php if (strlen($contentError) != 0):?>
            <p class="text-red-500"><?=$contentError; ?></p>
        <?php endif; ?>
    </form>
</section>
        <?php }