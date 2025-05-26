<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil semua user (kecuali admin)
$users_query = mysqli_query($conn, "SELECT * FROM user WHERE role = 'user'");
$users = [];
while ($row = mysqli_fetch_assoc($users_query)) {
    $users[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 judul-admin">Dashboard Admin</h2>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['nama_user']) ?></strong>!</p>
<style>
  /* === Global Styles === */
  body {
    background: linear-gradient(to bottom right, #f8f4ff, #e9ddff);
    font-family: 'Poppins', sans-serif;
    color: #3f1d63;
    margin: 0;
    padding: 0;
  }

  .judul-admin {
  color: #9d4edd;
  font-weight: 700;
}


  a {
    text-decoration: none;
  }

  /* === Card Styling === */
  .card.border-primary {
    border: none;
    background: linear-gradient(135deg, #c77dff, #9d4edd);
    color: #fff;
    box-shadow: 0 4px 12px rgba(157, 78, 221, 0.3);
    border-radius: 12px;
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: 600;
  }

  .card-text.fs-4 {
    font-size: 1.75rem;
    font-weight: bold;
  }

  /* === Table Styling === */
  table.table-bordered {
    border-color: #ddd;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
  }

  table thead {
    background-color: #e0b3ff;
    color: #4b0082;
  }

  table th, table td {
    text-align: center;
    vertical-align: middle;
    padding: 12px;
  }

  table tbody td:first-child {
    text-align: left; /* Kolom Nama */
  }

  table tbody td:last-child {
    text-align: left; /* Kolom Aksi */
  }

  /* === Button Styling === */
  .btn-info {
    background: linear-gradient(to right, #a259ff, #7b2cbf);
    border: none;
    color: white;
    font-weight: 500;
    border-radius: 8px;
    transition: 0.3s;
  }

  .btn-info:hover {
    background: linear-gradient(to right, #7b2cbf, #5a189a);
    color: #fff;
  }

  /* === Responsive === */
  @media (max-width: 768px) {
    .card-text.fs-4 {
      font-size: 1.4rem;
    }
    .card-title {
      font-size: 1rem;
    }
  }
</style>

    <?php
$total_user = count($users);
?>

<div class="row mb-4">
  <div class="col-md-6">
    <div class="card border-primary">
      <div class="card-body">
        <h5 class="card-title">Jumlah User Aktif</h5>
        <p class="card-text fs-4"><?= $total_user ?> pengguna</p>
      </div>
    </div>
  </div>
  
    <h4 class="mt-5">👤 Daftar User</h4>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $u): ?>
      <tr>
        <td><?= htmlspecialchars($u['nama']) ?></td>
        <td>
          <a href="lihat_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-info">Lihat</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
