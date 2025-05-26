<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
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

    input[type="email"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 15px;
      transition: border 0.3s;
    }

    input[type="email"]:focus {
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

    .back-to-login {
      margin-top: 10px;
      font-size: 14px;
    }

    .back-to-login p {
  font-size: 12px; /* atau 11px kalau mau lebih kecil */
}

    .back-to-login a {
      color: #7b1fa2;
      text-decoration: none;
      font-weight: bold;
    }

    .back-to-login a:hover {
      text-decoration: underline;
    }

    /* Tambahan untuk error */
    .error-message {
  background-color: #f8d7da;
  color: #721c24;
  padding: 10px 75px;
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
    <h2>Lupa Password</h2>

    <!-- Pesan error akan muncul kalau URL ada ?error=email -->
    <?php if (isset($_GET['error']) && $_GET['error'] == 'email'): ?>
      <div class="error-message">Email tidak terdaftar!</div>
    <?php endif; ?>

    <form action="kirim_reset.php" method="POST">
      <label for="email">Masukkan Email Anda:</label>
      <input type="email" name="email" id="email" required>
      <button type="submit">Kirim</button>
    </form>
    <div class="back-to-login">
      <p>Sudah ingat password? <a href="login.php">Kembali ke Login</a></p>
    </div>
  </div>
</body>
</html>
