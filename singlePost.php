<?php
declare(strict_types=1);
session_start();
require_once 'src/services/PostDisplayService.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/entities/PostEntity.php';
require_once 'src/models/PostsModel.php';
require_once 'src/entities/CommentEntity.php';
require_once 'src/services/CommentValidationService.php';
require_once 'src/services/CommentsBoxDisplayService.php';
require_once 'src/models/CommentsModel.php';

include_once 'header.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$hideCommentBox = false;

$contentError = "";
$content = $_POST['content'] ?? '';
$id = (int)$_GET['id'];
$contentValid = null;

$post = $PostsModel->getSingle($id);

if (!$post) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $contentValid = CommentValidationService::ContentValidation($content);

    if ($contentValid) {
        $CommentModel = new CommentsModel($db);
        $commentEntity = CommentsModel::AddCommentToDatabase($id, $content);
        $CommentModel->addComment($commentEntity);
        $hideCommentBox = true;
        $content = "";

    }
 }

$comment = $PostsModel->getComments($id);
echo PostDisplayService::displaySingle($post, $comment);

if (isset($_SESSION['loggedIn'])) {
    $content = CommentValidationService::ContentSpecialCharCheck($content);
    echo CommentsBoxDisplayService::commentBoxDisplay($content, $contentValid, $hideCommentBox);
}
?>