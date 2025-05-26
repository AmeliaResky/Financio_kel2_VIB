<?php
session_start();
include 'koneksi.php';

// Hanya redirect jika user mengakses sign up secara langsung saat sudah login
if (isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) === "sign_up.php") {
    header("Location: index.php");
    exit();
}

// Proses pendaftaran
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);

    // Cek apakah email sudah terdaftar
$cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
$cek_phone = mysqli_query($conn, "SELECT * FROM user WHERE phone = '$phone'");

if (mysqli_num_rows($cek_email) > 0) {
    $error = "Email sudah terdaftar.";
} elseif (mysqli_num_rows($cek_phone) > 0) {
    $error = "Nomor HP sudah terdaftar.";
} else {
    // Masukkan data ke database
    $stmt = $conn->prepare("INSERT INTO user (nama, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $password, $phone);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Gagal mendaftar. Coba lagi.";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Financio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="logo_financio.png" alt="Financio Logo">
        </div>
        <div class="right">
            <h2>Sign Up</h2>
            <?php if ($error): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>
            <form action="sign_up.php" method="POST">
                <div class="form-group"><input type="text" name="fullname" placeholder="Nama Lengkap" required></div>
                <div class="form-group"><input type="email" name="email" placeholder="Email" required></div>
                <div class="form-group"><input type="password" name="password" placeholder="Password" required></div>
                <div class="form-group"><input type="text" name="phone" placeholder="No HP" required></div>
                <div class="form-group"><button type="submit">Daftar</button></div>
            </form>
            <div class="login-link">
                Sudah punya akun? <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
