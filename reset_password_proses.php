<?php
include 'koneksi.php';

$email = $_POST['email'] ?? '';
$password_baru = $_POST['password_baru'] ?? '';

// Cek kalau email atau password kosong
if (empty($email) || empty($password_baru)) {
    header("Location: reset_password.php?email=" . urlencode($email) . "&error=kosong");
    exit;
}

// Ambil password lama dari database
$stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Cek apakah email ditemukan
if (!$user) {
    header("Location: reset_password.php?email=" . urlencode($email) . "&error=email_tidak_ditemukan");
    exit;
}

$password_lama_hash = $user['password'];

// Cek apakah password baru sama dengan lama
if (password_verify($password_baru, $password_lama_hash)) {
    header("Location: reset_password.php?email=" . urlencode($email) . "&error=sama");
    exit;
}

// Simpan password baru (hash)
$password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
$update->bind_param("ss", $password_baru_hash, $email);
$update->execute();

// Redirect ke login dengan pesan sukses
header("Location: login.php?reset=berhasil");
exit;
?>
