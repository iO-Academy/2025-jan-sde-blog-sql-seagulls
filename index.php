<?php
declare(strict_types=1);
session_start();
require_once 'src/services/DatabaseConnectionService.php';
require_once 'src/models/PostsModel.php';
require_once 'src/services/PostDisplayService.php';

$db = DatabaseConnectionService::connect();
$PostsModel = new PostsModel($db);

$sortOrder = 'newest';
if (isset($_GET['sort'])) {
    $sortPosts = $_GET['sort'];

    if ($sortPosts == "newest") {
        $sortOrder = "newest";
    } elseif ($sortPosts == "oldest") {
        $sortOrder = "oldest";
    } elseif ($sortPosts == "most_liked") {
        $sortOrder = "most_liked";
    } elseif ($sortPosts == "most_disliked") {
        $sortOrder = "most_disliked";
    }
}

$posts = $PostsModel->getAll($sortOrder);

include_once 'header.php';
?>

<body class="selection:bg-teal-200">
<section class="container lg:w-1/2 mx-auto flex flex-col gap-5">
    <form method="get">
        <div>
            <label for="sort" class="text-lg block xl:inline">Sort by:</label>
            <select onclick="this.form.submit()" id="sort" name="sort" class="px-3 py-2 text-lg w-full xl:w-auto">
                <option value="newest" <?php echo ($sortOrder == 'newest') ? 'selected' : ''; ?>>Newest</option>
                <option value="oldest" <?php echo ($sortOrder == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
                <option value="most_liked" <?php echo ($sortOrder == 'most_liked') ? 'selected' : ''; ?>>Most Liked</option>
                <option value="most_disliked" <?php echo ($sortOrder == 'most_disliked') ? 'selected' : ''; ?>>Most Disliked</option>
            </select>
        </div>
    </form>
    <?php
    echo PostDisplayService::displayAllPosts($posts);
    ?>
</section>
</body>
</html>