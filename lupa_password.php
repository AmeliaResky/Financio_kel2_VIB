<!-- lupa_password.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; padding: 50px; }
    .box { background: #fff; padding: 20px; max-width: 400px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
    input, button { width: 100%; padding: 10px; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Lupa Password</h2>
    <form action="kirim_reset.php" method="POST">
      <label>Masukkan Email Anda:</label>
      <input type="email" name="email" required>
      <button type="submit">Kirim Link Reset</button>
    </form>
  </div>
</body>
</html>
