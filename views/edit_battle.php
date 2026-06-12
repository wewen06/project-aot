<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya Komandan yang bisa mengedit!");
}
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM battles WHERE id = ?");
$stmt->execute([$id]);
$b = $stmt->fetch();

if(!$b) {
    die("Pertempuran tidak ditemukan");
}
include 'includes/header.php';
?>

<h2 style="text-align: center; padding-top: 1rem;">EDIT PERTEMPURAN</h2>
<div class="form-container" style="max-width:500px;">
    <form action="/aot-website/actions/edit_battle_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $b['id'] ?>">
        <input type="hidden" name="old_image_url" value="<?= htmlspecialchars($b['image_url'] ?? '') ?>">

        <div class="form-group">
            <label>Nama Pertempuran</label>
            <input type="text" name="name" value="<?= htmlspecialchars($b['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" value="<?= htmlspecialchars($b['location'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Pemenang</label>
            <input type="text" name="winner" value="<?= htmlspecialchars($b['winner'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="date" value="<?= htmlspecialchars($b['date'] ?? '') ?>">
        </div>

        <?php if(!empty($b['image_url'])): ?>
        <div class="form-group">
            <label>Gambar Saat Ini</label><br>
            <img src="/aot-website/<?= htmlspecialchars($b['image_url']) ?>" style="max-width: 150px; border-radius: 10px; margin-top: 5px;">
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*">
            <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-save">SIMPAN</button>
            <a href="battles.php" class="btn-cancel">BATAL</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>