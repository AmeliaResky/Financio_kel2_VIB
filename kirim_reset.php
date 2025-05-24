<?php
include 'koneksi.php';

$email = $_POST['email'] ?? '';

if (empty($email)) {
    die("Email tidak boleh kosong.");
}

// Cek apakah email ada
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Email tidak ditemukan.");
}

// Redirect langsung ke halaman reset password
header("Location: reset_password.php?email=" . urlencode($email));
exit();
?>
