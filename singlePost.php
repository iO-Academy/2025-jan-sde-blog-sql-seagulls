<?php

 declare(strict_types=1);
 require_once 'src/services/PostDisplayService.php';
 require_once 'src/services/DatabaseConnectionService.php';
 require_once 'src/entities/PostEntity.php';
 require_once 'src/models/PostsModel.php';

 $db = DatabaseConnectionService::connect();
 $PostsModel = new PostsModel($db);

$post = $PostsModel->getSingle((int)$_GET['id']);

if (!$post){
    header('Location: index.php');
}

 require_once 'header.php';
?>


<section class="container md:w-1/2 mx-auto">
    <article class="p-8 border border-solid rounded-md">
        <?php
        echo PostDisplayService::displaySingle($post);
        ?>
    </article>
</section>

</body>
</html>
