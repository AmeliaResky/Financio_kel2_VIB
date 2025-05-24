<?php
session_start();
include 'koneksi.php';

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);

    // Ambil data lengkap user (termasuk foto)
    $query_foto = $conn->prepare("SELECT nama, foto FROM user WHERE id = ?");
    $query_foto->bind_param("i", $user['id']);
    $query_foto->execute();
    $result_foto = $query_foto->get_result();
    $data_user = $result_foto->fetch_assoc();

    // Simpan ke session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama_user'] = $data_user['nama'];
    $_SESSION['foto_user'] = $data_user['foto'];

    header("Location: index.php");
    exit();
}

// Tangkap pesan error dari redirect
if (isset($_GET['error']) && $_GET['error'] == '1') {
    $error = "Email atau password salah.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!empty($email) && !empty($password)) {
    $query = "SELECT id, nama, password FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama_user'] = $user['nama'];
            header("Location: index.php");
            exit();
        } else {
            // Redirect dengan parameter error
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Redirect dengan parameter error
        header("Location: login.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Financio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cio">
        <div class="cio-left">
            <img src="logo_financio.png" alt="Logo Financio" class="cio-logo">
            <h2>Selamat Datang di Financio!</h2>
            <p>Pencatatan keuangan mahasiswa yang simpel dan efisien.</p>
        </div>
        <div class="cio-right">
            <div class="cio-login-box">
                <h3>Login</h3>
                <?php if (!empty($error)) : ?>
                    <p class="error-message"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <form method="post" action="login.php">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="remember-forgot">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                        <a href="lupa_password.php">Lupa password?</a>
                    </div>
                    <button type="submit">Masuk</button>
                    <p>Belum punya akun? <a href="sign_up.php">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
