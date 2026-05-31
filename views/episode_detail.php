<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM episodes WHERE id = ?");
$stmt->execute([$id]);
$e = $stmt->fetch();

if(!$e) {
    header("Location: episodes.php?error=Episode not found");
    exit();
}
?>

<div class="detail-container">
    <a href="episodes.php" class="back-link">← Back to Episodes</a>
    
    <div class="detail-card">
        <div class="detail-avatar episode-detail-avatar">
            <div class="detail-icon">🎬</div>
        </div>
        
        <div class="detail-info">
            <h1><?= htmlspecialchars($e['title']) ?></h1>
            
            <div class="detail-badges">
                <span class="badge season">📺 Season <?= $e['season'] ?></span>
                <span class="badge episode-num">🔢 Episode <?= $e['episode_number'] ?></span>
            </div>
            
            <div class="detail-section">
                <h3>Air Date</h3>
                <p><?= !empty($e['air_date']) ? date('F d, Y', strtotime($e['air_date'])) : 'Air date TBA' ?></p>
            </div>
            
            <div class="detail-section">
                <h3>Synopsis</h3>
                <p><?= htmlspecialchars($e['description'] ?? 'An exciting episode of Attack on Titan continuing the epic story of humanity\'s fight against the Titans.') ?></p>
            </div>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
                <div class="detail-actions">
                    <a href="edit_episode.php?id=<?= $e['id'] ?>" class="btn-edit">✏️ Edit Episode</a>
                    <a href="/aot-website/actions/delete_episode.php?id=<?= $e['id'] ?>" class="btn-delete" onclick="return confirmDelete('<?= addslashes($e['title']) ?>')">🗑️ Delete Episode</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.episode-detail-avatar {
    background: linear-gradient(135deg, #1a1a2a, #0d0d2a) !important;
}
.badge.season {
    background: rgba(153, 95, 47, 0.25);
    color: #b8733a;
}
.badge.episode-num {
    background: rgba(255, 193, 7, 0.2);
    color: #ffc107;
}
</style>

<?php include 'includes/footer.php'; ?>