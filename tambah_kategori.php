<?php
session_start(); // penting buat ambil user_id dari session
include 'koneksi.php';

$user_id  = $_SESSION['user_id'] ?? null;
$kategori = $_POST['nama_kategori'];
$batas    = $_POST['batas'];

// Cek kalau belum login
if (!$user_id) {
    die("User belum login.");
}

$query = "INSERT INTO kategori_batas (user_id, nama_kategori, batas) VALUES (?, ?, ?)";
$stmt  = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "isi", $user_id, $kategori, $batas);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menambahkan kategori: " . mysqli_error($conn);
}
?>
