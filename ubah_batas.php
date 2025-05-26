<?php
include 'koneksi.php';

session_start();
$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$batas_baru = $_POST['batas_baru'];

// Validasi input
if (is_numeric($id) && is_numeric($batas_baru)) {
    $stmt = mysqli_prepare($conn, "UPDATE kategori_batas SET batas = ? WHERE id = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, "iii", $batas_baru, $id, $user_id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php"); // kembali ke halaman utama
    } else {
        echo "Gagal memperbarui batas.";
    }
} else {
    echo "Data tidak valid.";
}
?>
