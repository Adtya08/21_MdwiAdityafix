<?php
require_once '../config.php';
require_once 'auth_check.php';

$success = $_GET['msg'] ?? '';
$result = $conn->query("SELECT * FROM kegiatan ORDER BY tanggal DESC, id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kegiatan - Admin SMKN 1 Dlanggu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="overflow-x:hidden;">

<?php include 'sidebar.php'; ?>

<div class="admin-main">
  <div class="admin-topbar">
    <h4><i class="bi bi-calendar-event me-2"></i>Data Kegiatan</h4>
    <div class="d-flex gap-2">
      <a href="tambah.php" class="btn-primary-smk"><i class="bi bi-plus-circle"></i> Tambah</a>
      <a href="logout.php" class="btn-delete"><i class="bi bi-box-arrow-left me-1"></i> Logout</a>
    </div>
  </div>

  <?php if ($success === 'added'): ?>
  <div style="background:#dcfce7;border:1px solid #bbf7d0;color:#166534;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:0.9rem;">
    <i class="bi bi-check-circle me-2"></i>Kegiatan berhasil ditambahkan.
  </div>
  <?php elseif ($success === 'updated'): ?>
  <div style="background:#dcfce7;border:1px solid #bbf7d0;color:#166534;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:0.9rem;">
    <i class="bi bi-check-circle me-2"></i>Kegiatan berhasil diperbarui.
  </div>
  <?php elseif ($success === 'deleted'): ?>
  <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:0.9rem;">
    <i class="bi bi-trash me-2"></i>Kegiatan berhasil dihapus.
  </div>
  <?php endif; ?>

  <div style="overflow-x:auto;">
    <table class="table-smk" style="min-width:700px;">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th>Judul Kegiatan</th>
          <th style="width:140px;">Tanggal</th>
          <th>Deskripsi</th>
          <th style="width:140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows === 0): ?>
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">Belum ada data kegiatan.</td></tr>
        <?php endif; ?>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td style="font-weight:600;"><?= htmlspecialchars($row['judul']) ?></td>
          <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
          <td style="max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            <?= htmlspecialchars(substr($row['deskripsi'], 0, 80)) ?>...
          </td>
          <td>
            <div class="d-flex gap-2 flex-wrap">
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
                <i class="bi bi-pencil-fill"></i> Edit
              </a>
              <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-delete"
                onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                <i class="bi bi-trash-fill"></i> Hapus
              </a>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
