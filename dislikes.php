<?php

session_start();

require_once 'src/models/PostsModel.php';
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/DislikesModel.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);
$DislikesModel = new DislikesModel($db);

$id = $_GET['id'];

$DislikesModel->trackDislikes($id, $_SESSION['username_id']);

$PostsModel->sendDislike($id);

header("Location: singlePost.php?id=$id");





