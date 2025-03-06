<?php

session_start();

require_once 'src/models/PostsModel.php';
require_once 'src/models/Likes_DislikesModel.php';

require_once 'src/services/DatabaseConnectionService.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$LikesModel = new LikesModel($db);

$id = $_GET['id'];

if (isset($_SESSION['username'])){
    $haveLiked = $LikesModel->trackActivity($id, $_SESSION['username_id']);
    $LikesModel->addLike($id, $_SESSION['username_id'], $haveLiked);
    header("Location: singlePost.php?id=$id");
} else {
    header("Location: login.php");
}