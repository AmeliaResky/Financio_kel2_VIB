
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$nama = $_POST['name'];
$foto = $_FILES['photo'];

$targetDir = "uploads/";
$targetFile = $targetDir . basename($foto["name"]);

// Cek apakah ada foto baru
if (($foto["tmp_name"])) {
    move_uploaded_file($foto["tmp_name"], $targetFile);
    $fotoPath = $targetFile;

if ($foto["tmp_name"]) {
  move_uploaded_file($foto["tmp_name"], $targetFile);
  $fotoPath = $targetFile;
} else {
  $fotoPath = "uploads/default.png";
}

    // Update nama dan foto
    $stmt = $conn->prepare("UPDATE user SET nama = ?, foto = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $fotoPath, $user_id);
} else {
    // Update hanya nama
    $stmt = $conn->prepare("UPDATE user SET nama = ? WHERE id = ?");
    $stmt->bind_param("si", $nama, $user_id);
}

$stmt->execute();

// Update session juga agar tampilannya langsung berubah
$_SESSION['nama_user'] = $nama;
$_SESSION['foto_user'] = $fotoPath;

// 🔄 Ambil ulang data dari database setelah update
$query = $conn->prepare("SELECT nama, foto FROM user WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$updatedUser = $result->fetch_assoc();

// ✅ Update session agar langsung tampil di header
$_SESSION['nama_user'] = $updatedUser['nama'];
$_SESSION['foto_user'] = $updatedUser['foto'];

// Redirect ke index
header("Location: index.php?update_success=true");
exit();
?>
