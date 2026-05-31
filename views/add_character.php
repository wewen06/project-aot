<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
?>

<h2>➕ TAMBAH KARAKTER BARU</h2>
<div class="form-container" style="max-width:500px;">
    <form action="/aot-website/actions/add_character.php" method="POST" onsubmit="return validateCharacterForm()">
        <div class="form-group">
            <label>⚔️ Nama Karakter *</label>
            <input type="text" name="name" id="name" placeholder="Contoh: Eren Yeager" required>
        </div>
        
        <div class="form-group">
            <label>🏢 Afiliasi</label>
            <select name="affiliation">
                <option value="">-- Pilih Pasukan --</option>
                <option value="Survey Corps">Survey Corps (Legiun Pengintai)</option>
                <option value="Garrison">Garrison (Pasukan Penjaga)</option>
                <option value="Military Police">Military Police (Polisi Militer)</option>
                <option value="Warrior Unit">Warrior Unit (Marley)</option>
                <option value="Other">Lainnya</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>🎖️ Rank</label>
            <select name="rank">
                <option value="">-- Pilih Rank --</option>
                <option value="Commander">Komandan</option>
                <option value="Captain">Kapten</option>
                <option value="Squad Leader">Komandan Regu</option>
                <option value="Soldier">Prajurit</option>
                <option value="Trainee">Kadet</option>
                <option value="Titan Shifter">Titan Shifter</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>🖼️ URL Gambar (opsional)</label>
            <input type="text" name="image_url" placeholder="https://...">
        </div>
        
        <div id="formError" class="error"></div>
        
        <div class="form-buttons">
            <button type="submit" class="btn-save">💾 SIMPAN</button>
            <a href="characters.php" class="btn-cancel">❌ BATAL</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>