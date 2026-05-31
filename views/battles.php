<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM battles ORDER BY date DESC");
$battles = $stmt->fetchAll();
?>

<div class="characters-header">
    <h2>🗺️ EPIC BATTLES</h2>
    <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="add_battle.php" class="btn-add">+ ADD NEW BATTLE</a>
    <?php endif; ?>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="alert success">✓ <?= htmlspecialchars($_GET['success']) ?></div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert error">✗ <?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<div class="profile-grid">
    <?php foreach($battles as $b): ?>
    <div class="profile-card">
        <div class="profile-avatar battle-avatar">
            <div class="avatar-icon">🗺️</div>
        </div>
        <div class="profile-info">
            <h3><?= htmlspecialchars($b['name']) ?></h3>
            <div class="profile-badge">
                <span class="affiliation">📍 <?= htmlspecialchars($b['location'] ?? 'Unknown') ?></span>
                <span class="rank">🏆 <?= htmlspecialchars($b['winner'] ?? 'Unknown') ?></span>
            </div>
            <p class="profile-desc">A legendary battle that shaped the fate of humanity.</p>
        </div>
        <div class="profile-actions">
            <a href="battle_detail.php?id=<?= $b['id'] ?>" class="btn-view">👁️ View</a>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="edit_battle.php?id=<?= $b['id'] ?>" class="btn-edit">✏️ Edit</a>
                <a href="/aot-website/actions/delete_battle.php?id=<?= $b['id'] ?>" class="btn-delete" onclick="return confirm('Hapus battle <?= addslashes($b['name']) ?>?')">🗑️ Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if(count($battles) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">🗺️</div>
            <h3>No Battles Yet</h3>
            <p>Click "Add New Battle" to start building your database.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>