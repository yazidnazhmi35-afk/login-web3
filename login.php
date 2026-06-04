<?php
session_start();

require_once 'database.php';
require_once 'user.php';

if (!isset($_POST['input_username']) || !isset($_POST['input_password'])) {
    header("Location: index.html");
    exit();
} else {
    $username = $_POST['input_username'];
    $password = $_POST['input_password'];

    $database = new Database();
    $db = $database->connect();

    $user_obj = new User($db);
    $user = $user_obj->login($username, $password);

    if ($user) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard/index.php");
        exit();
    } else {
        header("Location: index.html?error=1");
        exit();
    }
}
?>