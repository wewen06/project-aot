<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
?>

<h2 style="text-align:center; padding-top: 1rem;">TAMBAH EPISODE BARU</h2>
<div class="form-container" style="max-width:500px;">
<form action="/aot-website/actions/add_episode.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Judul Episode</label>
        <input type="text" name="title" placeholder="Contoh: To You, in 2000 Years" required>
    </div>

    <div class="form-group">
        <label>Season</label>
        <input type="number" name="season" placeholder="1">
    </div>

    <div class="form-group">
        <label>Episode ke-</label>
        <input type="number" name="episode_number" placeholder="1">
    </div>

    <div class="form-group">
        <label>Tanggal Tayang</label>
        <input type="date" name="air_date">
    </div>

    <div class="form-group">
        <label>Thumbnail Episode</label>
        <input type="file" name="image" accept="image/*">
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn-save">SIMPAN</button>
        <a href="episodes.php" class="btn-cancel">BATAL</a>
    </div>
</form>
</div>

<?php include 'includes/footer.php'; ?>