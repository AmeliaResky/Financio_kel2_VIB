<?php
$email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Password</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #7b1fa2, #9c27b0);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .box {
      background: #ffffff;
      padding: 30px 40px;
      max-width: 400px;
      width: 90%;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    .box h2 {
      margin-bottom: 20px;
      color: #6a1b9a;
      font-size: 24px;
    }

    label {
      display: block;
      text-align: left;
      font-weight: 500;
      margin-bottom: 6px;
      color: #333;
    }

    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 15px;
      transition: border 0.3s;
    }

    input[type="password"]:focus {
      border-color: #9c27b0;
      outline: none;
    }

    button {
  background-color: #8e24aa;
  color: #fff;
  border: none;
  padding: 12px 80px; /* tambah padding horizontal */
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: auto; /* biar sesuai ukuran konten */
  display: block; /* supaya bisa ditengahin */
  margin: 0 auto; /* ini buat ketengahin */
}

    button:hover {
      background-color: #ba68c8;
    }
    /* Tambahan untuk error */
    .error-message {
  background-color: #f8d7da;
  color: #721c24;
  padding: 10px 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  border: 1px solid #f5c6cb;
  font-size: 14px;

  /* tambahan untuk ketengah */
  text-align: center;
  width: fit-content;
  margin: 0 auto 20px auto;
}
  </style>
</head>
<body>
  <div class="box">
    <h2>Hapus Password Lama</h2>

     <?php if (isset($_GET['error'])): ?>
  <?php if ($_GET['error'] == 'sama'): ?>
    <div class="error-message">Password baru tidak boleh sama dengan password lama.</div>
  <?php elseif ($_GET['error'] == 'kosong'): ?>
    <div class="error-message">Email dan password baru wajib diisi.</div>
  <?php elseif ($_GET['error'] == 'email_tidak_ditemukan'): ?>
    <div class="error-message">Email tidak ditemukan.</div>
  <?php endif; ?>
<?php endif; ?>
    <form action="reset_password_proses.php" method="POST">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <label>Password Baru:</label>
      <input type="password" name="password_baru" required>
      <button type="submit">Simpan Password</button>
    </form>
  </div>
</body>
</html>
