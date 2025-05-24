<?php
include 'koneksi.php';

$email = $_POST['email'] ?? '';
$password_baru = $_POST['password_baru'] ?? '';

if (empty($password_baru)) {
    die("Password tidak boleh kosong.");
}

$hash = password_hash($password_baru, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE user SET password = ?, updated_at = NOW() WHERE email = ?");
$stmt->bind_param("ss", $hash, $email);

if ($stmt->execute()) {
    echo "Password berhasil diubah. <a href='login.php'>Login sekarang</a>";
} else {
    echo "Gagal mengubah password: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
