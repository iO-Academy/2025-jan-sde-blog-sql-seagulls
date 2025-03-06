<?php

session_start();

require_once 'src/models/PostsModel.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/LikesModel.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$LikesModel = new LikesModel($db);

$id = $_GET['id'];

if (isset($_SESSION['username'])){
    $LikesModel->trackLikes($id, $_SESSION['username_id']);
    header("Location: singlePost.php?id=$id");
} else {
    header("Location: login.php");
}