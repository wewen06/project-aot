<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM battles WHERE id = ?");
$stmt->execute([$id]);
$b = $stmt->fetch();

if(!$b) {
    header("Location: battles.php?error=Battle not found");
    exit();
}
?>

<div class="detail-container">
    <a href="battles.php" class="back-link">← Back to Battles</a>
    
    <div class="detail-card">
        <div class="detail-avatar battle-detail-avatar">
            <?php if(!empty($b['image_url'])): ?>
                <img src="/aot-website/<?= htmlspecialchars($b['image_url']) ?>" alt="<?= htmlspecialchars($b['name']) ?>">
            <?php else: ?>
                <div class="detail-icon">🗺️</div>
            <?php endif; ?>
        </div>
        
        <div class="detail-info">
            <h1><?= htmlspecialchars($b['name']) ?></h1>
            
            <div class="detail-badges">
                <span class="badge location"><?= htmlspecialchars($b['location'] ?? 'Unknown Location') ?></span>
                <span class="badge winner">Winner: <?= htmlspecialchars($b['winner'] ?? 'Unknown') ?></span>
            </div>
            
            <div class="detail-section">
                <h3>Battle Date</h3>
                <p><?= !empty($b['date']) ? date('F d, Y', strtotime($b['date'])) : 'Date unknown' ?></p>
            </div>
            
            <div class="detail-section">
                <h3>About This Battle</h3>
                <p><?= htmlspecialchars($b['description'] ?? 'A crucial battle in the war between humanity and the Titans. This conflict changed the course of history within the walls.') ?></p>
            </div>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
                <div class="detail-actions">
                    <a href="edit_battle.php?id=<?= $b['id'] ?>" class="btn-edit">Edit Battle</a>
                    <a href="/aot-website/actions/delete_battle.php?id=<?= $b['id'] ?>" class="btn-delete" onclick="return confirmDelete('<?= addslashes($b['name']) ?>')">Delete Battle</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.battle-detail-avatar {
    background: linear-gradient(135deg, #1a2a1a, #0d2a0d) !important;
}
.badge.location {
    background: rgba(153, 95, 47, 0.25);
    color: #b8733a;
}
.badge.winner {
    background: rgba(255, 193, 7, 0.2);
    color: #ffc107;
}
</style>

<?php include 'includes/footer.php'; ?>