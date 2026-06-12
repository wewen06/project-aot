<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
?>

<!-- HERO SECTION (RATA KIRI) -->
<section class="hero">
    <div class="hero-flex">
        <div class="hero-content" style="text-align: left; margin-left: 0; margin-right: auto;">
            <span class="hero-badge">SEASON 4 FINAL</span>
            <h1>Attack on <span>Titan</span></h1>
            <div class="hero-tags" style="justify-content: flex-start;">
                <span class="tag">Action</span>
                <span class="tag">Dark Fantasy</span>
                <span class="tag">Drama</span>
                <span class="tag">Thriller</span>
            </div>
            <p class="hero-desc" style="margin-left: 0; margin-right: 0;">
                In a world where humanity lives inside cities surrounded by enormous walls 
                due to the Titans, gigantic humanoid creatures, Eren Yeager swears to 
                destroy them after witnessing a devastating attack.
            </p>
        </div>
        <div class="hero-image">
            <img src="/aot-website/assets/images/aot-logo.png" alt="Attack on Titan" class="hero-logo">
        </div>
    </div>
</section>

<!-- CHARACTERS SECTION (CENTERED) -->
<section class="section">
    <div class="section-header">
        <h2>Main Characters</h2>
        <a href="characters.php" class="section-link">View All →</a>
    </div>
    <div class="card-grid">
        <?php
        require_once '../config/database.php';
        $stmt = $pdo->query("SELECT * FROM characters LIMIT 5");
        $characters = $stmt->fetchAll();
        foreach($characters as $c):
        ?>
        <div class="character-card">
            <div class="card-image">
                <?php if(!empty($c['image_url'])): ?>
                    <img src="/aot-website/<?= htmlspecialchars($c['image_url']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
                <?php else: ?>
                    ⚔️
                <?php endif; ?>
            </div>
            <div class="card-content">
                <h3><?= htmlspecialchars($c['name']) ?></h3>
                <p><?= htmlspecialchars($c['affiliation'] ?? 'Survey Corps') ?></p>
                <span class="card-rank"><?= htmlspecialchars($c['rank'] ?? 'Soldier') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<br>
<br>
<!-- BATTLES SECTION (CENTERED) -->
<section class="section">
    <div class="section-header">
        <h2>Epic Battles</h2>
        <a href="battles.php" class="section-link">View All →</a>
    </div>
    <div class="card-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM battles LIMIT 5");
        $battles = $stmt->fetchAll();
        foreach($battles as $b):
        ?>
        <div class="character-card">
            <div class="card-image">
                <?php if(!empty($b['image_url'])): ?>
                    <img src="/aot-website/<?= htmlspecialchars($b['image_url']) ?>" alt="<?= htmlspecialchars($b['name']) ?>">
                <?php else: ?>
                    🗺️
                <?php endif; ?>
            </div>
            <div class="card-content">
                <h3><?= htmlspecialchars($b['name']) ?></h3>
                <p><?= htmlspecialchars($b['location'] ?? 'Unknown') ?></p>
                <span class="card-rank">Winner: <?= htmlspecialchars($b['winner'] ?? '—') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<br>
<br>
<!-- EPISODES SECTION (CENTERED) -->
<section class="section">
    <div class="section-header">
        <h2>Recent Episodes</h2>
        <a href="episodes.php" class="section-link">View All →</a>
    </div>
    <div class="card-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM episodes ORDER BY id DESC LIMIT 5");
        $episodes = $stmt->fetchAll();
        foreach($episodes as $e):
        ?>
        <div class="character-card">
            <div class="card-image">
                <?php if(!empty($e['image_url'])): ?>
                    <img src="/aot-website/<?= htmlspecialchars($e['image_url']) ?>" alt="<?= htmlspecialchars($e['title']) ?>">
                <?php else: ?>
                    🎬
                <?php endif; ?>
            </div>
            <div class="card-content">
                <h3><?= htmlspecialchars($e['title']) ?></h3>
                <p>Season <?= $e['season'] ?> • Episode <?= $e['episode_number'] ?></p>
                <span class="card-rank">Air Date: <?= htmlspecialchars($e['air_date'] ?? 'TBA') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<p class="motto">
    "Shinzou wo sasageyo!" — Dedicate Your Heart
</p>

<?php include 'includes/footer.php'; ?>