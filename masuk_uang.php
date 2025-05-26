<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id    = $_SESSION['user_id'] ?? null;
    $nominal    = $_POST['nominal'] ?? null;
    $tanggal    = $_POST['tanggal'] ?? null;
    $kategori   = $_POST['kategori'] ?? null;
    $keterangan = $_POST['keterangan'] ?? null;

    if ($user_id && $nominal && $tanggal && $kategori) {
        $query = "INSERT INTO uang_masuk (user_id, nominal, tanggal, kategori, keterangan) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("iisss", $user_id, $nominal, $tanggal, $kategori, $keterangan);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal insert data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Data tidak lengkap!";
    }
} else {
    echo "Akses langsung tidak diperbolehkan.";
}
?>
