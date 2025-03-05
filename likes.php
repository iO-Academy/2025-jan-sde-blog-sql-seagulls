<?php

session_start();

require_once 'src/models/PostsModel.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/LikesModel.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$LikesModel = new LikesModel($db);

$id = $_GET['id'];

$LikesModel->trackLikes($id, $_SESSION['username_id']);

//if (!isset($_SESSION['hasLikedThis'])){
//    $_SESSION['hasLikedThis'] = true;
    $PostsModel->sendLike($id);
//    echo "$id";
    header("Location: singlePost.php?id=$id");
//} else {
//    echo "$id is this";
////    header("Location: singlePost.php?id=$id");
//}





