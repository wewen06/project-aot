<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM episodes ORDER BY season DESC, episode_number DESC");
$episodes = $stmt->fetchAll();
?>

<div class="characters-header">
    <h2>ANIME EPISODES</h2>
    <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="add_episode.php" class="btn-add">ADD EPISODE</a>
    <?php endif; ?>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="alert success">✓ <?= htmlspecialchars($_GET['success']) ?></div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert error">✗ <?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<div class="profile-grid">
    <?php foreach($episodes as $e): ?>
    <div class="profile-card">
        <div class="profile-avatar episode-avatar">
            <?php if(!empty($e['image_url'])): ?>
                <img src="/aot-website/<?= htmlspecialchars($e['image_url']) ?>" alt="<?= htmlspecialchars($e['title']) ?>">
            <?php else: ?>
                <div class="avatar-icon">🎬</div>
            <?php endif; ?>
        </div>
        <div class="profile-info">
            <h3><?= htmlspecialchars($e['title']) ?></h3>
            <div class="profile-badge">
                <span class="affiliation">Season <?= $e['season'] ?></span>
                <span class="rank">Episode <?= $e['episode_number'] ?></span>
            </div>
            <p class="profile-desc"><?= !empty($e['air_date']) ? 'Aired: ' . date('d M Y', strtotime($e['air_date'])) : 'TBA' ?></p>
        </div>
        <div class="profile-actions">
            <a href="episode_detail.php?id=<?= $e['id'] ?>" class="btn-view">View</a>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="edit_episode.php?id=<?= $e['id'] ?>" class="btn-edit">Edit</a>
                <a href="/aot-website/actions/delete_episode.php?id=<?= $e['id'] ?>" class="btn-delete" onclick="return confirm('Hapus episode <?= addslashes($e['title']) ?>?')">Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if(count($episodes) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">🎬</div>
            <h3>No Episodes Yet</h3>
            <p>Click "Add New Episode" to start building your database.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>