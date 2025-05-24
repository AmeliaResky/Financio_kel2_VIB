<?php
include 'koneksi.php';

$email = $_POST['email'] ?? '';

if (empty($email)) {
    // Bisa juga kamu redirect balik ke form dengan error khusus
    header("Location: lupa_password.php?error=kosong");
    exit();
}

// Cek apakah email ada
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Kalau email tidak ditemukan, redirect balik dengan error
    header("Location: lupa_password.php?error=email");
    exit();
}

// Jika email ditemukan, arahkan ke halaman reset password
header("Location: reset_password.php?email=" . urlencode($email));
exit();
?>
