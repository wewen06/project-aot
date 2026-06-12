<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya Komandan yang bisa mengedit!");
}
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM episodes WHERE id = ?");
$stmt->execute([$id]);
$e = $stmt->fetch();

if(!$e) {
    die("Episode tidak ditemukan");
}
include 'includes/header.php';
?>

<h2 style="text-align: center; padding-top: 1rem;">EDIT EPISODE</h2>
<div class="form-container" style="max-width:500px;">
    <form action="/aot-website/actions/edit_episode_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $e['id'] ?>">
        <input type="hidden" name="old_image_url" value="<?= htmlspecialchars($e['image_url'] ?? '') ?>">

        <div class="form-group">
            <label>Judul Episode</label>
            <input type="text" name="title" value="<?= htmlspecialchars($e['title']) ?>" required>
        </div>

        <div class="form-group">
            <label>Season</label>
            <input type="number" name="season" value="<?= $e['season'] ?>">
        </div>

        <div class="form-group">
            <label>Episode ke-</label>
            <input type="number" name="episode_number" value="<?= $e['episode_number'] ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Tayang</label>
            <input type="date" name="air_date" value="<?= htmlspecialchars($e['air_date'] ?? '') ?>">
        </div>

        <?php if(!empty($e['image_url'])): ?>
        <div class="form-group">
            <label>Thumbnail Saat Ini</label><br>
            <img src="/aot-website/<?= htmlspecialchars($e['image_url']) ?>" style="max-width: 150px; border-radius: 10px; margin-top: 5px;">
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Ganti Thumbnail (opsional)</label>
            <input type="file" name="image" accept="image/*">
            <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-save">SIMPAN</button>
            <a href="episodes.php" class="btn-cancel">BATAL</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>