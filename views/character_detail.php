<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/database.php';
include 'includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch();

if(!$c) {
    header("Location: characters.php?error=Character not found");
    exit();
}
?>

<div class="detail-container">
    <a href="characters.php" class="back-link">← Back to Characters</a>
    
    <div class="detail-card">
        <div class="detail-avatar">
            <?php if(!empty($c['image_url']) && filter_var($c['image_url'], FILTER_VALIDATE_URL)): ?>
                <img src="<?= htmlspecialchars($c['image_url']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
            <?php else: ?>
                <div class="detail-icon">⚔️</div>
            <?php endif; ?>
        </div>
        
        <div class="detail-info">
            <h1><?= htmlspecialchars($c['name']) ?></h1>
            
            <div class="detail-badges">
                <span class="badge affiliation">🏢 <?= htmlspecialchars($c['affiliation'] ?? 'Survey Corps') ?></span>
                <span class="badge rank">🎖️ <?= htmlspecialchars($c['rank'] ?? 'Soldier') ?></span>
            </div>
            
            <div class="detail-section">
                <h3>About</h3>
                <p><?= htmlspecialchars($c['description'] ?? 'A dedicated soldier of the Survey Corps, fighting for humanity\'s survival against the Titans.') ?></p>
            </div>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
                <div class="detail-actions">
                    <a href="edit_character.php?id=<?= $c['id'] ?>" class="btn-edit">✏️ Edit Character</a>
                    <a href="/aot-website/actions/delete_character.php?id=<?= $c['id'] ?>" class="btn-delete" onclick="return confirmDelete('<?= addslashes($c['name']) ?>')">🗑️ Delete Character</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.detail-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

.back-link {
    color: var(--brown-primary);
    text-decoration: none;
    margin-bottom: 1.5rem;
    display: inline-block;
}

.back-link:hover {
    color: var(--brown-light);
}

.detail-card {
    background: rgba(25, 18, 12, 0.55);
    backdrop-filter: blur(12px);
    border-radius: 30px;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
}

.detail-avatar {
    flex: 1;
    min-width: 250px;
    background: linear-gradient(135deg, #1a120b, #2d1a0a);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.detail-avatar img {
    width: 100%;
    max-width: 300px;
    border-radius: 20px;
    object-fit: cover;
}

.detail-icon {
    font-size: 8rem;
}

.detail-info {
    flex: 2;
    padding: 2rem;
}

.detail-info h1 {
    font-family: 'Cinzel', serif;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.detail-badges {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.badge {
    padding: 0.3rem 1rem;
    border-radius: 30px;
    font-size: 0.8rem;
}

.badge.affiliation {
    background: rgba(153, 95, 47, 0.25);
    color: var(--brown-light);
}

.badge.rank {
    background: rgba(153, 95, 47, 0.15);
    color: var(--text-muted);
}

.detail-section {
    margin: 1.5rem 0;
}

.detail-section h3 {
    font-family: 'Cinzel', serif;
    margin-bottom: 0.5rem;
    color: var(--brown-primary);
}

.detail-section p {
    color: var(--text-muted);
    line-height: 1.6;
}

.detail-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

@media (max-width: 768px) {
    .detail-card {
        flex-direction: column;
    }
    
    .detail-info h1 {
        font-size: 1.8rem;
    }
    
    .detail-actions {
        flex-direction: column;
    }
}
</style>

<?php include 'includes/footer.php'; ?>