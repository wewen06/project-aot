<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya Komandan yang bisa mengedit!");
}
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch();

if(!$c) {
    die("Karakter tidak ditemukan");
}
include 'includes/header.php';
?>

<h2 style="text-align: center; padding-top: 1rem;">EDIT KARAKTER</h2>
<div class="form-container" style="max-width:500px;">
    <form action="/aot-website/actions/edit_character_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $c['id'] ?>">
        <input type="hidden" name="old_image_url" value="<?= htmlspecialchars($c['image_url'] ?? '') ?>">

        <div class="form-group">
            <label>Nama Karakter</label>
            <input type="text" name="name" value="<?= htmlspecialchars($c['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Afiliasi</label>
            <input type="text" name="affiliation" value="<?= htmlspecialchars($c['affiliation'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Rank</label>
            <input type="text" name="rank" value="<?= htmlspecialchars($c['rank'] ?? '') ?>">
        </div>

        <?php if(!empty($c['image_url'])): ?>
        <div class="form-group">
            <label>Gambar Saat Ini</label><br>
            <img src="/aot-website/<?= htmlspecialchars($c['image_url']) ?>" style="max-width: 150px; border-radius: 10px; margin-top: 5px;">
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*">
            <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-save">SIMPAN</button>
            <a href="characters.php" class="btn-cancel">BATAL</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>