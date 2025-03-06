<?php
declare(strict_types=1);
session_start();
require_once 'src/models/UsersModel.php';
require_once 'src/services/DatabaseConnectionService.php';

$db = DatabaseConnectionService::connect();

if (isset($_SESSION['loggedIn'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $UsersModel = new UsersModel($db);
    $register = $UsersModel->register($username, $password, $email);
    if ($register) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['reg-error'] = '<p class="text-red-500">Registration unsuccessful </p>';
    }
}
include_once 'header.php';
?>

<form method="post" class="container lg:w-1/4 mx-auto flex flex-col p-8 bg-slate-200">
    <h2 class="text-3xl mb-4 text-center">Register</h2>
    <div class="mb-5">
        <label class="mb-3 block" for="username">Username:</label>
        <input class="w-full px-3 py-2 text-lg" type="text" id="username" name="username" />
    </div>
    <div class="mb-5">
        <label class="mb-3 block" for="email">Email:</label>
        <input class="w-full px-3 py-2 text-lg" type="email" id="email" name="email" />
    </div>
    <div class="mb-5">
        <label class="mb-3 block" for="password">Password:</label>
        <input class="w-full px-3 py-2 text-lg" type="password" id="password" name="password" />
    </div>
    <?php
    if (isset($_SESSION['reg-error'])) {
        echo '<p class="text-red-500">' . $_SESSION['reg-error'] . ' </p>';
    }
    ?>
    <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" value="Register" name="submit" />
</form>
</body>
</html>