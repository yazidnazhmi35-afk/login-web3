<?php
require_once 'database.php';
require_once 'user.php';

$username = $_POST['username'] ?? "";
$email = $_POST['email'] ?? "";
$asal = $_POST['asal'] ?? "";
$password = $_POST['password'] ?? "";
$password_ulang = $_POST['password_ulang'] ?? "";

$title = "";
$icon = "";
$heading = "";
$message = "";
$link_url = "signup.html";
$link_text = "Kembali";

if (!isset($_POST['setuju'])) {
    $title = "Pendaftaran Gagal";
    $icon = "⚠️";
    $heading = "Gagal";
    $message = "Anda harus menyetujui syarat & ketentuan form.";
} elseif ($password != $password_ulang) {
    $title = "Pendaftaran Gagal";
    $icon = "❌";
    $heading = "Password Berbeda";
    $message = "Password dan Konfirmasi Password tidak sama.";
} else {
    $database = new Database();
    $db = $database->connect();
    $user = new User($db);
    
    $result = $user->create($username, $email, $asal, $password);
    
    if ($result === true) {
        $title = "Pendaftaran Berhasil";
        $icon = "🎉";
        $heading = "Berhasil!";
        $message = "Data berhasil ditambahkan. Silakan login.";
        $link_url = "index.html";
        $link_text = "Menuju Halaman Login";
    } else {
        $title = "Pendaftaran Gagal";
        $icon = "❌";
        $heading = "Terjadi Kesalahan";
        $message = "Error: " . $result;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #007bff;
            --primary-hover: #0056b3;
            --bg-color: #f4f7f6;
            --glass-bg: #ffffff;
            --glass-border: #dddddd;
            --text-main: #333333;
            --text-muted: #666666;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-color);
            color: var(--text-main);
            overflow: hidden;
            padding: 20px;
        }
        .message-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-main);
        }
        .header p {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: var(--primary-hover);
        }
    </style>
</head>
<body>
    <div class="message-container">
        <div class="icon"><?php echo $icon; ?></div>
        <div class="header">
            <h1><?php echo $heading; ?></h1>
            <p><?php echo $message; ?></p>
        </div>
        <a href="<?php echo $link_url; ?>" class="btn"><?php echo $link_text; ?></a>
    </div>
</body>
</html>