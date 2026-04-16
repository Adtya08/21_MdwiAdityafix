<?php
require_once '../config.php';
require_once 'auth_check.php';

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    // Get gambar filename before delete
    $stmt = $conn->prepare("SELECT gambar FROM kegiatan WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Delete image file if exists
    if (!empty($res['gambar']) && file_exists('../assets/img/' . $res['gambar'])) {
        unlink('../assets/img/' . $res['gambar']);
    }

    $stmt = $conn->prepare("DELETE FROM kegiatan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: kegiatan.php?msg=deleted');
exit;
