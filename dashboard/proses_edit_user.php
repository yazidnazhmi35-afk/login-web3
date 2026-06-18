<?php

require_once '../database.php';
require_once '../user.php';

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$asal = $_POST['asal'];
$password = $_POST['password'];
$id = $_POST['id'];


$database = new Database();
$db = $database->connect();
$user = new User($db);

$user->update($id, $username, $email, $asal, $password);

header("Location: index.php?halaman=daftar_users.php");