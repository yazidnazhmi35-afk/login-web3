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

        // Menggunakan cookie untuk melacak jumlah login tanpa database (berlaku 30 hari)
        $cookie_name = "login_count_" . preg_replace('/[^a-zA-Z0-9_]/', '', $user['username']);
        $count = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] + 1 : 1;
        setcookie($cookie_name, $count, time() + (86400 * 30), "/"); 
        
        $_SESSION['login_count'] = $count;
        $_SESSION['show_login_alert'] = true;

        header("Location: dashboard/index.php");
        exit();
    } else {
        header("Location: index.html?error=1");
        exit();
    }
}
?>