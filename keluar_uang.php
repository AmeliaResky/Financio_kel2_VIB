<?php
include 'koneksi.php';

$kategori = strtolower(trim($_POST['kategori']));
$nominal = $_POST['nominal'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$batasBaru = isset($_POST['batas_baru']) ? $_POST['batas_baru'] : null;

// Jika kategori belum ada di kategori_batas, tambahkan
if ($batasBaru !== null && is_numeric($batasBaru)) {
    $cek = mysqli_query($conn, "SELECT * FROM kategori_batas WHERE LOWER(nama_kategori) = '$kategori'");
    if (mysqli_num_rows($cek) == 0) {
        $stmt = mysqli_prepare($conn, "INSERT INTO kategori_batas (nama_kategori, batas) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "si", $kategori, $batasBaru);
        mysqli_stmt_execute($stmt);
    }
}

// Simpan ke tabel uang_keluar
$stmt2 = mysqli_prepare($conn, "INSERT INTO uang_keluar (kategori, nominal, tanggal, keterangan) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt2, "siss", $kategori, $nominal, $tanggal, $keterangan);

if (mysqli_stmt_execute($stmt2)) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>
