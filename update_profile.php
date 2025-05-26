<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$nama = isset($_POST['name']) ? trim($_POST['name']) : '';

// Ambil data lama
$stmt = $conn->prepare("SELECT nama, foto FROM user WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Jika nama kosong, tetap pakai yang lama
if ($nama === '') {
    $nama = $userData['nama'];
}

$foto = $_FILES['photo'];
$fotoPath = $userData['foto'] ?? 'uploads/default.png';

// Upload foto jika ada
if (!empty($foto["tmp_name"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($foto["name"]);
    move_uploaded_file($foto["tmp_name"], $targetFile);
    $fotoPath = $targetFile;

    $stmt = $conn->prepare("UPDATE user SET nama = ?, foto = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $fotoPath, $user_id);
} else {
    $stmt = $conn->prepare("UPDATE user SET nama = ? WHERE id = ?");
    $stmt->bind_param("si", $nama, $user_id);
}

$stmt->execute();

// Update session
$_SESSION['nama_user'] = $nama;
$_SESSION['foto_user'] = $fotoPath;

// Redirect balik ke section #profile
header("Location: index.php?update_success=true#profile");
exit();
?>
