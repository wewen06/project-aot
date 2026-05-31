<?php include 'includes/header.php'; ?>
<div class="form-container">
    <h2>📝 DAFTAR TENTARA BARU</h2>
    
    <?php if(isset($_GET['error'])): ?>
        <div class="alert error">❌ <?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    
    <form action="/aot-website/actions/register_process.php" method="POST" onsubmit="return validateRegister()">
        <div class="form-group">
            <label>📛 Username</label>
            <input type="text" name="username" id="reg_username" placeholder="Pilih username" required>
        </div>
        <div class="form-group">
            <label>🔒 Password</label>
            <input type="password" name="password" id="reg_password" placeholder="Minimal 4 karakter" required>
        </div>
        <div class="form-group">
            <label>🔒 Konfirmasi Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Ketik ulang password" required>
        </div>
        <div id="regError" class="error"></div>
        <button type="submit">DAFTAR</button>
    </form>
    <p style="text-align:center; margin-top:20px;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
<?php include 'includes/footer.php'; ?>