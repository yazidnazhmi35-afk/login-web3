<?php
 include "../user.php";
 include "../database.php";

 $db = new Database();
 $conn = $db->connect();
 $user = new User($conn);

 $id = $_GET['id'];
 $user->hapus($id);
 header("Location: daftar_users.php");