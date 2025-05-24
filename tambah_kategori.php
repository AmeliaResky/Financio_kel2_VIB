<?php
include 'koneksi.php';

$kategori = $_POST['nama_kategori'];
$batas = $_POST['batas'];

$query = "INSERT INTO kategori_batas (nama_kategori, batas) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $kategori, $batas);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php"); // arahkan ke dashboard atau halaman utama
} else {
    echo "Gagal menambahkan kategori.";
}
?>
