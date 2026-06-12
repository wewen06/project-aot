<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
?>

<h2 style="text-align:center; padding-top: 1rem;">TAMBAH PERTEMPURAN BARU</h2>
<div class="form-container" style="max-width:500px;">
<form action="/aot-website/actions/add_battle.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Pertempuran</label>
        <input type="text" name="name" placeholder="Contoh: Battle of Trost" required>
    </div>

    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="location" placeholder="Contoh: Trost District">
    </div>

    <div class="form-group">
        <label>Pemenang</label>
        <input type="text" name="winner" placeholder="Contoh: Survey Corps">
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="date">
    </div>

    <div class="form-group">
        <label>Gambar Pertempuran</label>
        <input type="file" name="image" accept="image/*">
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn-save">SIMPAN</button>
        <a href="battles.php" class="btn-cancel">BATAL</a>
    </div>
</form>
</div>

<?php include 'includes/footer.php'; ?>