<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID user tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']);

// Ambil data user
$user_query = mysqli_query($conn, "SELECT * FROM user WHERE id = $id AND role = 'user'");
$user_data = mysqli_fetch_assoc($user_query);

if (!$user_data) {
    echo "User tidak ditemukan!";
    exit;
}

$nama_user = $user_data['nama'];
$email_user = isset($user_data['email']) ? $user_data['email'] : '-';

// Ambil transaksi terakhir
$last_trans_query = mysqli_query($conn, "SELECT tanggal FROM (
        SELECT tanggal FROM uang_masuk WHERE user_id = $id
        UNION
        SELECT tanggal FROM uang_keluar WHERE user_id = $id
    ) AS gabungan ORDER BY tanggal DESC LIMIT 1
");
$last_trans = mysqli_fetch_assoc($last_trans_query);
$aktivitas_terakhir = $last_trans ? $last_trans['tanggal'] : '-';

// Ambil total jumlah transaksi
$jumlah_trans_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM (
        SELECT id FROM uang_masuk WHERE user_id = $id
        UNION ALL
        SELECT id FROM uang_keluar WHERE user_id = $id
    ) AS gabungan
");
$jumlah_trans = mysqli_fetch_assoc($jumlah_trans_query)['total'] ?? 0;

// Ambil data transaksi
$query = "SELECT 'Masuk' AS tipe, nominal, tanggal, kategori FROM uang_masuk WHERE user_id = $id
    UNION
    SELECT 'Keluar' AS tipe, nominal, tanggal, kategori FROM uang_keluar WHERE user_id = $id
    ORDER BY tanggal DESC
";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data <?= htmlspecialchars($nama_user) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="text-primary mb-4">📊 Data Keuangan: <?= htmlspecialchars($nama_user) ?></h2>

    <a href="dashboard_admin.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>

    <style>
    body {
        background: linear-gradient(to right, #d0bfff, #f3e8ff);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        font-weight: bold;
        color: #6f42c1;
    }

    .btn-secondary {
        background-color: #9b59b6;
        border-color: #8e44ad;
    }

    .btn-secondary:hover {
        background-color: #8e44ad;
        border-color: #7d3c98;
    }

    .card-title {
        color: #6f42c1;
    }

    .card {
        border: none;
        border-left: 5px solid #6f42c1;
        background-color: #fff;
        transition: 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(111, 66, 193, 0.2);
    }

    .table th {
        background-color: #e0ccff;
        color: #4a0072;
    }

    .table td {
        vertical-align: middle;
    }

    .badge-success {
        background-color: #7e57c2;
    }

    .badge-danger {
        background-color: #c2185b;
    }

    .alert-warning {
        background-color: #fce4ec;
        color: #6f42c1;
        border: 1px solid #f8bbd0;
    }
</style>

    <!-- Informasi User -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">🧾 Informasi User</h5>
            <p><strong>Nama:</strong> <?= htmlspecialchars($nama_user) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email_user) ?></p>
            <p><strong>Aktivitas Terakhir:</strong> <?= htmlspecialchars($aktivitas_terakhir) ?></p>
            <p><strong>Total Transaksi:</strong> <?= htmlspecialchars($jumlah_trans) ?> transaksi</p>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <?php if (mysqli_num_rows($data) === 0): ?>
        <div class="alert alert-warning">Belum ada data transaksi untuk user ini.</div>
    <?php else: ?>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><span class="badge bg-<?= $row['tipe'] == 'Masuk' ? 'success' : 'danger' ?>"><?= $row['tipe'] ?></span></td>
                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                        <td>Rp<?= number_format($row['nominal'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
