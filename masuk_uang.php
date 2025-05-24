<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Amanin supaya gak error kalau ada POST kosong
    $nominal    = isset($_POST['nominal']) ? $_POST['nominal'] : null;
    $tanggal    = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
    $kategori   = isset($_POST['kategori']) ? $_POST['kategori'] : null;
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : null;

    // Cek dulu kalau field penting tidak kosong
    if ($nominal !== null && $tanggal !== null && $kategori !== null) {
        $query = "INSERT INTO uang_masuk (nominal, tanggal, kategori, keterangan)
                  VALUES ('$nominal', '$tanggal', '$kategori', '$keterangan')";

        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error query: " . mysqli_error($conn);
        }
    } else {
        echo "Form belum lengkap.";
    }
} else {
    echo "Akses langsung tidak diperbolehkan.";
}
?>
