<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil batas kategori milik user
$batas_query = $conn->prepare("SELECT nama_kategori, batas FROM kategori_batas WHERE user_id = ?");
$batas_query->bind_param("i", $user_id);
$batas_query->execute();
$resultBatas = $batas_query->get_result();

$limits = [];
while ($row = $resultBatas->fetch_assoc()) {
    $limits[$row['nama_kategori']] = (int)$row['batas'];
}

// Ambil data pengeluaran per kategori milik user
$query = $conn->prepare("SELECT kategori, SUM(nominal) as total_pengeluaran FROM uang_keluar WHERE user_id = ? GROUP BY kategori");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$categories = [];
$expenses = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['kategori'];
    $expenses[] = (int)$row['total_pengeluaran'];
}

// Bisa kamu sesuaikan mau echo json atau tampil di halaman
?>
