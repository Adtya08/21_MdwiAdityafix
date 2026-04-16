<?php
require_once '../config.php';
require_once 'auth_check.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';
    $gambar = null;

    if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
        $error = 'Semua field wajib diisi.';
    } else {
        // Handle file upload
        if (!empty($_FILES['gambar']['name'])) {
            $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed)) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['gambar']['name']);
                $uploadPath = '../assets/img/' . $filename;
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath)) {
                    $gambar = $filename;
                }
            }
        }

        $stmt = $conn->prepare("INSERT INTO kegiatan (judul, deskripsi, tanggal, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $deskripsi, $tanggal, $gambar);
        $stmt->execute();
        $stmt->close();
        header('Location: kegiatan.php?msg=added');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kegiatan - Admin SMKN 1 Dlanggu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="overflow-x:hidden;">

<?php include 'sidebar.php'; ?>

<div class="admin-main">
  <div class="admin-topbar">
    <h4><i class="bi bi-plus-circle me-2"></i>Tambah Kegiatan</h4>
    <a href="logout.php" class="btn-delete"><i class="bi bi-box-arrow-left me-1"></i> Logout</a>
  </div>

  <?php if ($error): ?>
  <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:0.9rem;">
    <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
  </div>
  <?php endif; ?>

  <div class="form-card" style="max-width:720px;">
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="form-label-smk">Judul Kegiatan <span style="color:#ef4444;">*</span></label>
        <input type="text" name="judul" class="form-control-smk"
          placeholder="Masukkan judul kegiatan"
          value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>" required>
      </div>

      <div class="mb-4">
        <label class="form-label-smk">Tanggal Kegiatan <span style="color:#ef4444;">*</span></label>
        <input type="date" name="tanggal" class="form-control-smk"
          value="<?= htmlspecialchars($_POST['tanggal'] ?? '') ?>" required>
      </div>

      <div class="mb-4">
        <label class="form-label-smk">Deskripsi Kegiatan <span style="color:#ef4444;">*</span></label>
        <textarea name="deskripsi" class="form-control-smk" rows="5"
          placeholder="Tuliskan deskripsi kegiatan..." required
          style="resize:vertical;"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
      </div>

      <div class="mb-5">
        <label class="form-label-smk">Gambar Kegiatan <span style="color:#94a3b8;font-weight:400;">(opsional)</span></label>
        <input type="file" name="gambar" class="form-control-smk" accept="image/*"
          style="padding:10px 14px;">
        <div style="font-size:0.78rem;color:var(--text-muted);margin-top:6px;">
          Format: JPG, PNG, GIF, WEBP. Ukuran maks: 2MB
        </div>
      </div>

      <div class="d-flex gap-3">
        <button type="submit" class="btn-primary-smk">
          <i class="bi bi-check-circle"></i> Simpan Kegiatan
        </button>
        <a href="kegiatan.php" class="btn-edit" style="padding:10px 20px;font-size:0.9rem;">
          <i class="bi bi-arrow-left me-1"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
