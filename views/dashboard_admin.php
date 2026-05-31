<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
?>

<!-- HERO SECTION ADMIN (RATA KIRI) -->
<section class="hero" style="min-height: 50vh;">
    <div class="hero-content" style="text-align: left; margin-left: 0; margin-right: auto;">
        <span class="hero-badge">ADMIN PANEL</span>
        <h1>Welcome, <br><span>Commander</span><br><?= htmlspecialchars($_SESSION['username']) ?></h1>
        <p class="hero-desc" style="margin-left: 0; margin-right: 0;">
            You have full authority over the Survey Corps database. <br>
            Manage characters, battles, and episodes with full CRUD access.
        </p>
    </div>
</section>

<!-- ADMIN CARDS GRID (CENTERED) -->
<div class="admin-grid">
    <div class="admin-card">
        <div style="font-size: 3rem;">⚔️</div>
        <h3>Characters</h3>
        <p>Create, Read, Update, Delete</p>
        <a href="characters.php" class="btn-primary" style="display: inline-block;">Manage</a>
    </div>
    <div class="admin-card">
        <div style="font-size: 3rem;">🗺️</div>
        <h3>Battles</h3>
        <p>Create, Read, Update, Delete</p>
        <a href="battles.php" class="btn-primary" style="display: inline-block;">Manage</a>
    </div>
    <div class="admin-card">
        <div style="font-size: 3rem;">🎬</div>
        <h3>Episodes</h3>
        <p>Create, Read, Update, Delete</p>
        <a href="episodes.php" class="btn-primary" style="display: inline-block;">Manage</a>
    </div>
</div>

<p class="motto">
    "Dedicate your heart!" — Shinzou wo sasageyo!
</p>

<?php include 'includes/footer.php'; ?>