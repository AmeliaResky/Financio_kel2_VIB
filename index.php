<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user yang login
$user_id = $_SESSION['user_id'];
$queryUser = "SELECT nama, foto FROM user WHERE id = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$fotoProfil = htmlspecialchars($user['foto'] ?? 'uploads/default.png');
$namaUser = htmlspecialchars($user['nama']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Money</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 16.66667%;
      height: 100vh;
      padding-top: 20px;
      background-color: #f8f9fa;
      z-index: 1000;
    }

    .col-md-10 {
      margin-left: 17%;
      padding: 20px;
      overflow: auto;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">

    <!-- Sidebar -->
      <?php
// Koneksi ke database untuk mengambil data user terbaru
$conn = new mysqli("localhost", "root", "", "money_app");
$query = "SELECT nama, foto FROM user WHERE id = 1";
$result = $conn->query($query);
$user = $result->fetch_assoc();

// Tentukan foto profil (gunakan foto default jika belum ada)
$fotoProfil = $user['foto'] ? $user['foto'] : 'uploads/default.png';
$namaUser = $user['nama'];
?>
      <!-- Sidebar -->
      <div class="col-md-2 sidebar bg-light p-3">
        <nav class="nav flex-column">
          <a class="nav-link active" href="#" onclick="showSection('dashboard')">Dashboard</a>
          <a class="nav-link" href="#" onclick="showSection('uangMasuk')">Uang Masuk</a>
          <a class="nav-link" href="#" onclick="showSection('uangKeluar')">Uang Keluar</a>
          <a class="nav-link" href="#" onclick="showSection('laporan')">Laporan</a>
          <div class="profile-sidebar position-absolute bottom-0 start-0 w-100 p-3">

  <!-- Gambar dan Nama saja yang bisa ke profil -->
  <div class="d-flex align-items-center mb-3" style="margin-top: -10px;">
    <img src="<?= $fotoProfil ?>" alt="Profile" class="rounded-circle me-3" width="40" height="40" style="cursor: pointer;" onclick="showSection('profile')">
    <span style="cursor: pointer;" onclick="showSection('profile')"><?= $namaUser ?></span>
  </div>

    <!-- Logout tetap aman -->
<a href="#" style="background:red; color:white; padding:10px; border-radius:5px; text-decoration:none;" onclick="return konfirmasiLogout(event)">Logout</a>

<script>
function konfirmasiLogout(event) {
  event.stopPropagation(); // Cegah logout dianggap klik ke elemen lain
  const yakin = confirm("Yakin mau keluar, <?= htmlspecialchars($namaUser) ?>? 😢");
  if (yakin) {
    window.location.href = "logout.php";
  }
  return false;
}
</script>

  </div>
</div>

 <!-- Profile Sidebar -->
  <div class="profile-sidebar position-absolute bottom-0 start-0 w-100 p-3" style="border-top">
    <div class="d-flex align-items-center" style="cursor: pointer;" onclick="showSection('profile')">
      <img src="<?= $fotoProfil ?>" alt="Profile" class="rounded-circle me-2" width="40" height="40" id="profilePicSidebar">
      <span id="profileNameSidebar"><?= htmlspecialchars($namaUser) ?></span>
    </div>
  </div>
</div>


      <!-- Main Content -->
      <div class="col-md-10 p-4">
        <?php
        include 'koneksi.php';
        // Hitung total uang masuk
        $q_masuk = mysqli_query($conn, "SELECT SUM(nominal) as total_masuk FROM uang_masuk");
        $totalMasuk = mysqli_fetch_assoc($q_masuk)['total_masuk'] ?? 0;
        // Hitung total uang keluar
        $q_keluar = mysqli_query($conn, "SELECT SUM(nominal) as total_keluar FROM uang_keluar");
        $totalKeluar = mysqli_fetch_assoc($q_keluar)['total_keluar'] ?? 0;
        // Hitung saldo
        $saldo = $totalMasuk - $totalKeluar;
        ?>

        <!-- Section Dashboard -->
        <section id="dashboard" class="content-section">
          <h2>Dashboard</h2>
          <div id="alertContainer"></div>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="card text-bg-success mb-3">
                <div class="card-body">
                  <h5 class="card-title">Saldo Saat Ini</h5>
                  <p class="card-text"style="font-size: 20px ;">Rp. <?= number_format($saldo, 0, ',', '.') ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card text-bg-danger mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Pengeluaran</h5>
                  <p class="card-text"style="font-size: 20px ;">Rp. <?= number_format($totalKeluar, 0, ',', '.') ?></p>
                </div>
              </div>
            </div>
          </div>
<div style="max-width: 800px; margin: 0 auto;"> 
<?php include 'chart.php'; ?>
    
</div>
        </section>

        <!-- Section Uang Masuk -->
        <section id="uangMasuk" class="content-section" style="display: none;">
          <h2>Uang Masuk</h2>
          <form action="masuk_uang.php" method="POST">
            <div class="mb-3">
              <label for="nominal" class="form-label">Nominal (Rp)</label>
              <input type="number" class="form-control" id="nominal" name="nominal" required>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input list="daftar-kategori" class="form-control" id="kategori" name="kategori" placeholder="pilih atau tulis kategori" required>
              <datalist id="daftar-kategori">
    <option value="Elektronik">
    <option value="Pakaian">
    <option value="Makanan">
    <option value="Aksesoris">
  </datalist>
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
          </form>
        </section>

        <!-- Section Uang Keluar -->
        <section id="uangKeluar" class="content-section" style="display: none;">
          <h2>Uang Keluar</h2>
          <form action="keluar_uang.php" method="POST">
            <div class="mb-3">
              <label for="nominal" class="form-label">Nominal (Rp)</label>
              <input type="number" class="form-control" id="nominal" name="nominal" required>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input list="daftar-kategori" class="form-control" id="kategori" name="kategori" placeholder="pilih atau tulis kategori" required>
              <datalist id="daftar-kategori">
    <option value="Elektronik">
    <option value="Pakaian">
    <option value="Makanan">
    <option value="Aksesoris">
  </datalist>
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
          </form>
        </section>

        <!-- Section Laporan -->
        <section id="laporan" class="content-section" style="display: none;">
          <h2>Laporan Keuangan</h2>
          <?php include 'laporan.php'; ?>
        </section>

<!-- Script Scroll ke Atas -->
<script>
  function scrollToSection(id) {
    const targetSection = document.getElementById(id);
    if (targetSection) {
      setTimeout(() => {
        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100); // Memberikan sedikit waktu agar animasi accordion selesai
    }
  }
</script>

 <!-- section profile -->
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "money_app");

// Ambil data user dari database

$query = $conn->prepare("SELECT nama, email, phone, foto FROM user WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$data = $result->fetch_assoc();
?>

<section id="profile" class="content-section" style="display: none">
  <form action="update_profile.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="name" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['nama']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($data['email']) ?>" disabled>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">No HP</label>
      <input type="text" class="form-control" id="phone" value="<?= htmlspecialchars($data['phone']) ?>" disabled>
    </div>
    <div class="mb-3">
      <label for="photo" class="form-label">Foto Profil</label>
      <input type="file" class="form-control" id="photo" name="photo" onchange="previewImage(event)">
      <div class="mt-2">
        <img src="<?= htmlspecialchars($_SESSION['foto_user'] ?? 'uploads/default.png') ?>" class="rounded-circle" width="100" height="100">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Profil</button>
  </form>
   <!-- FORM TAMBAH KATEGORI -->
<h2 class="mt-4 mb-2">Kelola Kategori & Batas</h2>
<form action="tambah_kategori.php" method="POST" class="row g-3 mb-4">
  <div class="col-md-6">
    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
  </div>
  <div class="col-md-4">
    <input type="number" name="batas" class="form-control" placeholder="Batas Pengeluaran" required>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-success w-100">Tambah</button>
  </div>
</form>

<!-- TABEL EDIT BATAS KATEGORI -->
<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM kategori_batas ORDER BY nama_kategori ASC");
?>

<h2 class="mt-4 mb-2">Edit Batas Kategori </h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nama Kategori</th>
      <th>Batas Saat Ini</th>
      <th>Ubah Batas</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
        <td>Rp <?= number_format($row['batas'], 0, ',', '.') ?></td>
        <td>
          <form action="ubah_batas.php" method="POST" class="d-flex">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="number" name="batas_baru" class="form-control me-2" placeholder="Batas baru" required>
            <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
          </form>
</section>

 
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</section>
<script>
  function showSection(id) {
    console.log("Tampilkan section:", id); // bantu debug

    const sections = document.querySelectorAll(".content-section");
    sections.forEach(section => section.style.display = "none");

    const target = document.getElementById(id);
    if (target) target.style.display = "block";
    else console.warn("ID section tidak ditemukan:", id);

    const links = document.querySelectorAll(".nav-link");
    links.forEach(link => link.classList.remove("active"));

    const activeLink = [...links].find(link =>
      link.textContent.replace(/\s/g, "").toLowerCase() === id.toLowerCase()
    );
    if (activeLink) activeLink.classList.add("active");
  }

  function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function(){
    document.getElementById('preview').src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}

  window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('update_success') === 'true') {
      const updatedName = "<?= htmlspecialchars($namaUser) ?>";
      const updatedFoto = "<?= $fotoProfil ?>";
      document.getElementById("profileNameSidebar").textContent = updatedName;
      document.getElementById("profilePicSidebar").src = updatedFoto;
    }
  };
</script>
    
<!-- Bootstrap JS Bundle (termasuk Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
