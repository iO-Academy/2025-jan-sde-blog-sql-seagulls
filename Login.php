<?php
declare(strict_types=1);
session_start();

require_once 'src/models/UsersModel.php';
require_once 'src/services/DatabaseConnectionService.php';

$db = DatabaseConnectionService::connect();

if (!isset($_SESSION['loggedIn'])) {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $UsersModel = new UsersModel($db);
        $login = $UsersModel->login($username, $password);
        if ($login) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } else {
            $_SESSION['error'] = '<p class="text-red-500">Username and/or password are incorrect </p>';
        }
    }
} else {
    header('Location: index.php');
}
include_once 'header.php';
?>

<form method="post" class="container lg:w-1/4 mx-auto flex flex-col p-8 bg-slate-200">
    <h2 class="text-3xl mb-4 text-center">Login</h2>
    <div class="mb-5">
        <label class="mb-3 block" for="username">Username:</label>
        <input class="w-full px-3 py-2 text-lg" type="text" name="username" id="username" />
    </div>

    <div class="mb-5">
        <label class="mb-3 block" for="password">Password:</label>
        <input class="w-full px-3 py-2 text-lg" type="password" name="password" id="password" />
    </div>
    <div>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        }
        ?>
    </div>
    <input class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" type="submit" name="submit" value="Login" />
</form>