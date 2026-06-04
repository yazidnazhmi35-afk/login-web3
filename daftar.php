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
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-color: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
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
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.15) 0%, transparent 50%);
            color: var(--text-main);
            overflow: hidden;
            padding: 20px;
        }
        .message-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
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
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
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