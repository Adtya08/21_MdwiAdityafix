<!-- Admin Sidebar -->
<div class="admin-sidebar">
  <div class="sidebar-logo">
    <div class="d-flex align-items-center gap-2">
      <img src="../assets/img/logo.png" alt="Logo" class="brand-icon">
      <div>
        <div style="color:rgba(255,255,255,0.6);font-size:0.68rem;text-transform:uppercase;letter-spacing:1px;">Admin Panel</div>
        <strong>SMKN 1 Dlanggu</strong>
      </div>
    </div>
  </div>

  <div class="sidebar-nav" style="display:flex;flex-direction:column;height:calc(100vh - 100px);">
    <div style="flex:1;">
      <a href="dashboard.php" class="<?= (basename($_SERVER['PHP_SELF']) === 'dashboard.php') ? 'active' : '' ?>">
        <i class="bi bi-grid-1x2"></i> Dashboard
      </a>
      <a href="kegiatan.php" class="<?= (basename($_SERVER['PHP_SELF']) === 'kegiatan.php') ? 'active' : '' ?>">
        <i class="bi bi-calendar-event"></i> Data Kegiatan
      </a>
      <a href="tambah.php" class="<?= (basename($_SERVER['PHP_SELF']) === 'tambah.php') ? 'active' : '' ?>">
        <i class="bi bi-plus-circle"></i> Tambah Kegiatan
      </a>
      <a href="../index.php" style="margin-top:8px;">
        <i class="bi bi-globe"></i> Lihat Website
      </a>
    </div>
    <a href="logout.php" class="logout-link">
      <i class="bi bi-box-arrow-left"></i> Logout
    </a>
  </div>
</div>
