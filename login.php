<?php
require_once 'config.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: admin/dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator - SMKN 1 Dlanggu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login-wrapper">
  <div class="login-box">
    <img src="assets/img/logo.png" alt="Logo" class="login-logo">
    <h2>Administrator</h2>
    <p class="sub">Masuk ke Panel Admin SMKN 1 Dlanggu</p>

    <?php if ($error): ?>
    <div class="alert-error">
      <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-4">
        <label class="form-label-smk">Username</label>
        <div style="position:relative;">
          <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;">
            <i class="bi bi-person"></i>
          </span>
          <input type="text" name="username" class="form-control-smk" placeholder="Masukkan username"
            style="padding-left:40px;"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
        </div>
      </div>
      <div class="mb-5">
        <label class="form-label-smk">Password</label>
        <div style="position:relative;">
          <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;">
            <i class="bi bi-lock"></i>
          </span>
          <input type="password" name="password" class="form-control-smk" placeholder="Masukkan password"
            style="padding-left:40px;" required>
        </div>
      </div>
      <button type="submit" class="btn-smk">
        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
      </button>
    </form>

    <div class="text-center mt-4">
      <a href="index.php" style="font-size:0.85rem;color:var(--text-muted);text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman Utama
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
