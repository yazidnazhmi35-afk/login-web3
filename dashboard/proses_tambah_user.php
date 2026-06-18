<?php

require_once '../database.php';
require_once '../user.php';

$username = $_POST['username'];
$email = $_POST['email'];
$asal = $_POST['asal'];
$password = $_POST['password'];

$database = new Database();
$db = $database->connect();
$user = new User($db);

$result = $user->create($username, $email, $asal, $password);

header("Location: index.php");