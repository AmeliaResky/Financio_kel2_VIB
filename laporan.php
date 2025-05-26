<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Akses tidak diizinkan.";
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!-- Collapsible Laporan Uang Masuk & Keluar -->
<div class="accordion mb-3" id="accordionLaporan">
  <!-- Laporan Uang Masuk -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingMasuk">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMasuk" aria-expanded="true" aria-controls="collapseMasuk">
        Laporan Uang Masuk
      </button>
    </h2>
    <div id="collapseMasuk" class="accordion-collapse collapse show" aria-labelledby="headingMasuk" data-bs-parent="#accordionLaporan">
      <div class="accordion-body">
        <table class="table table-striped">
          <thead>
            <tr><th>Tanggal</th><th>Nominal</th><th>Kategori</th><th>Keterangan</th></tr>
          </thead>
          <tbody>
            <?php
            // Tampilkan uang masuk hanya untuk user yang login
            $masuk = mysqli_query($conn, "SELECT * FROM uang_masuk WHERE user_id = $user_id ORDER BY tanggal DESC");
            while ($row = mysqli_fetch_assoc($masuk)) {
              echo "<tr>
                      <td>{$row['tanggal']}</td>
                      <td>Rp " . number_format($row['nominal'], 0, ',', '.') . "</td>
                      <td>{$row['kategori']}</td>
                      <td>{$row['keterangan']}</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Laporan Uang Keluar -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingKeluar">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKeluar" aria-expanded="false" aria-controls="collapseKeluar">
        Laporan Uang Keluar
      </button>
    </h2>
    <div id="collapseKeluar" class="accordion-collapse collapse" aria-labelledby="headingKeluar" data-bs-parent="#accordionLaporan">
      <div class="accordion-body">
        <table class="table table-striped">
          <thead>
            <tr><th>Tanggal</th><th>Nominal</th><th>Kategori</th><th>Keterangan</th></tr>
          </thead>
          <tbody>
            <?php
            // Tampilkan uang keluar hanya untuk user yang login
            $keluar = mysqli_query($conn, "SELECT * FROM uang_keluar WHERE user_id = $user_id ORDER BY tanggal DESC");
            while ($row = mysqli_fetch_assoc($keluar)) {
              echo "<tr>
                      <td>{$row['tanggal']}</td>
                      <td>Rp " . number_format($row['nominal'], 0, ',', '.') . "</td>
                      <td>{$row['kategori']}</td>
                      <td>{$row['keterangan']}</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
