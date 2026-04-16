<?php
require_once '../config.php';
require_once 'auth_check.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: kegiatan.php'); exit; }

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM kegiatan WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) { header('Location: kegiatan.php'); exit; }
$row = $result->fetch_assoc();
$stmt->close();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul    = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tanggal  = $_POST['tanggal'] ?? '';
    $gambar   = $row['gambar']; // keep existing

    if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
        $error = 'Semua field wajib diisi.';
    } else {
        // Handle new file upload
        if (!empty($_FILES['gambar']['name'])) {
            $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed)) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['gambar']['name']);
                $uploadPath = '../assets/img/' . $filename;
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath)) {
                    // Delete old image
                    if ($gambar && file_exists('../assets/img/' . $gambar)) {
                        unlink('../assets/img/' . $gambar);
                    }
                    $gambar = $filename;
                }
            }
        }

        $stmt = $conn->prepare("UPDATE kegiatan SET judul=?, deskripsi=?, tanggal=?, gambar=? WHERE id=?");
        $stmt->bind_param("ssssi", $judul, $deskripsi, $tanggal, $gambar, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: kegiatan.php?msg=updated');
        exit;
    }

    // Update row preview on error
    $row['judul'] = $judul;
    $row['deskripsi'] = $deskripsi;
    $row['tanggal'] = $tanggal;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kegiatan - Admin SMKN 1 Dlanggu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="overflow-x:hidden;">

<?php include 'sidebar.php'; ?>

<div class="admin-main">
  <div class="admin-topbar">
    <h4><i class="bi bi-pencil-square me-2"></i>Edit Kegiatan</h4>
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
          value="<?= htmlspecialchars($row['judul']) ?>" required>
      </div>

      <div class="mb-4">
        <label class="form-label-smk">Tanggal Kegiatan <span style="color:#ef4444;">*</span></label>
        <input type="date" name="tanggal" class="form-control-smk"
          value="<?= htmlspecialchars($row['tanggal']) ?>" required>
      </div>

      <div class="mb-4">
        <label class="form-label-smk">Deskripsi Kegiatan <span style="color:#ef4444;">*</span></label>
        <textarea name="deskripsi" class="form-control-smk" rows="5"
          placeholder="Tuliskan deskripsi kegiatan..." required
          style="resize:vertical;"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
      </div>

      <div class="mb-5">
        <label class="form-label-smk">Gambar Kegiatan</label>
        <?php if (!empty($row['gambar'])): ?>
        <div style="margin-bottom:10px;">
          <img src="../assets/img/<?= htmlspecialchars($row['gambar']) ?>" alt="current"
            style="height:80px;border-radius:8px;object-fit:cover;border:1px solid var(--border);">
          <div style="font-size:0.78rem;color:var(--text-muted);margin-top:4px;">Gambar saat ini</div>
        </div>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control-smk" accept="image/*"
          style="padding:10px 14px;">
        <div style="font-size:0.78rem;color:var(--text-muted);margin-top:6px;">
          Kosongkan jika tidak ingin mengganti gambar.
        </div>
      </div>

      <div class="d-flex gap-3">
        <button type="submit" class="btn-primary-smk">
          <i class="bi bi-check-circle"></i> Perbarui Kegiatan
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
