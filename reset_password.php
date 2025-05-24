<?php
$email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; padding: 50px; }
    .box { background: #fff; padding: 20px; max-width: 400px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
    input, button { width: 100%; padding: 10px; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Reset Password</h2>
    <form action="reset_password_proses.php" method="POST">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <label>Password Baru:</label>
      <input type="password" name="password_baru" required>
      <button type="submit">Simpan Password</button>
    </form>
  </div>
</body>
</html>
