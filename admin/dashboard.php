<?php
require_once '../config.php';
require_once 'auth_check.php';

$total = $conn->query("SELECT COUNT(*) as c FROM kegiatan")->fetch_assoc()['c'];
$latest = $conn->query("SELECT * FROM kegiatan ORDER BY tanggal DESC, id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Admin SMKN 1 Dlanggu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="overflow-x:hidden;">

<?php include 'sidebar.php'; ?>

<div class="admin-main">
  <!-- Topbar -->
  <div class="admin-topbar">
    <div>
      <h4>Dashboard</h4>
      <div style="font-size:0.8rem;color:var(--text-muted);">Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></div>
    </div>
    <a href="logout.php" class="btn-delete">
      <i class="bi bi-box-arrow-left me-1"></i> Logout
    </a>
  </div>

  <!-- Stats -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div style="background:var(--gradient);border-radius:var(--radius);padding:28px;color:#fff;box-shadow:var(--shadow);">
        <div style="font-size:2.5rem;font-weight:800;"><?= $total ?></div>
        <div style="opacity:0.8;margin-top:4px;font-size:0.92rem;">Total Kegiatan</div>
        <i class="bi bi-calendar-event" style="font-size:2rem;opacity:0.2;position:absolute;right:28px;top:28px;"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div style="background:#fff;border-radius:var(--radius);padding:28px;border:1px solid var(--border);box-shadow:var(--shadow);">
        <div style="font-size:2.5rem;font-weight:800;color:var(--primary);"><?= date('Y') ?></div>
        <div style="color:var(--text-muted);margin-top:4px;font-size:0.92rem;">Tahun Aktif</div>
      </div>
    </div>
    <div class="col-md-4">
      <div style="background:#fff;border-radius:var(--radius);padding:28px;border:1px solid var(--border);box-shadow:var(--shadow);">
        <a href="tambah.php" class="btn-primary-smk" style="display:inline-flex;">
          <i class="bi bi-plus-circle"></i> Tambah Kegiatan
        </a>
        <div style="color:var(--text-muted);margin-top:12px;font-size:0.82rem;">Tambahkan informasi kegiatan baru</div>
      </div>
    </div>
  </div>

  <!-- Latest Activities -->
  <div style="background:#fff;border-radius:var(--radius);border:1px solid var(--border);box-shadow:var(--shadow);overflow:hidden;">
    <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
      <h5 style="font-weight:700;color:var(--primary);margin:0;font-size:1rem;">Kegiatan Terbaru</h5>
      <a href="kegiatan.php" class="btn-edit">Lihat Semua</a>
    </div>
    <table class="table-smk" style="border-radius:0;border:none;">
      <thead>
        <tr>
          <th>#</th>
          <th>Judul Kegiatan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $latest->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['judul']) ?></td>
          <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
          <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit me-1">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-delete"
              onclick="return confirm('Yakin hapus kegiatan ini?')">Hapus</a>
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
