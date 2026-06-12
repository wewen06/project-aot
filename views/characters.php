<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM characters ORDER BY id DESC");
$characters = $stmt->fetchAll();
?>

<div class="characters-header">
    <h2>SURVEY CORPS CHARACTERS</h2>
    <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="add_character.php" class="btn-add">ADD CHARACTER</a>
    <?php endif; ?>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="alert success">✓ <?= htmlspecialchars($_GET['success']) ?></div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert error">✗ <?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<!-- PROFILE CARDS GRID -->
<div class="profile-grid">
    <?php foreach($characters as $c): ?>
    <div class="profile-card">
        <div class="profile-avatar">
            <?php if(!empty($c['image_url'])): ?>
                <img src="/aot-website/<?= htmlspecialchars($c['image_url']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
            <?php else: ?>
                <div class="avatar-icon">⚔️</div>
            <?php endif; ?>
        </div>
        
        <div class="profile-info">
            <h3><?= htmlspecialchars($c['name']) ?></h3>
            <div class="profile-badge">
                <span class="affiliation"><?= htmlspecialchars($c['affiliation'] ?? 'Survey Corps') ?></span>
                <span class="rank"><?= htmlspecialchars($c['rank'] ?? 'Soldier') ?></span>
            </div>
            
            <?php if(!empty($c['description'])): ?>
                <p class="profile-desc"><?= htmlspecialchars($c['description']) ?></p>
            <?php else: ?>
                <p class="profile-desc">A brave soldier fighting for humanity within the walls.</p>
            <?php endif; ?>
        </div>
        
        <div class="profile-actions">
            <a href="character_detail.php?id=<?= $c['id'] ?>" class="btn-view">View</a>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="edit_character.php?id=<?= $c['id'] ?>" class="btn-edit">Edit</a>
                <a href="/aot-website/actions/delete_character.php?id=<?= $c['id'] ?>" class="btn-delete" onclick="return confirmDelete('<?= addslashes($c['name']) ?>')">Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if(count($characters) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">⚔️</div>
            <h3>No Characters Yet</h3>
            <p>Click "Add New Character" to start building your database.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>