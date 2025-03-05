<?php

 declare(strict_types=1);
 require_once 'src/services/PostDisplayService.php';
 require_once 'src/services/DatabaseConnectionService.php';
 require_once 'src/entities/PostEntity.php';
 require_once 'src/models/PostsModel.php';
 require_once 'src/entities/CommentEntity.php';

 $db = DatabaseConnectionService::connect();
 $PostsModel = new PostsModel($db);

$post = $PostsModel->getSingle((int)$_GET['id']);

if (!$post){
    header('Location: index.php');
}

$comment = $PostsModel->getComments((int)$_GET['id']);

//if (!$comment){
//    header('Location: index.php');
//}
require_once 'header.php';
?>



        <?php
        echo PostDisplayService::displaySingle($post, $comment);
        ?>