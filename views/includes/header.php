<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attack on Titan | Survey Corps</title>
    <link rel="stylesheet" href="/aot-website/assets/css/style.css">
    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚔️</text></svg>">
</head>
<body>
    <nav>
        <div class="logo">⚔️ SURVEY <span>CORPS</span></div>
        <ul class="nav-links">
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="/aot-website/views/dashboard_<?= $_SESSION['role'] ?>.php">Home</a></li>
                <li><a href="/aot-website/views/characters.php">Characters</a></li>
                <li><a href="/aot-website/views/battles.php">Battles</a></li>
                <li><a href="/aot-website/views/episodes.php">Episodes</a></li>
                <li><a href="/aot-website/actions/logout.php" class="nav-btn">Logout</a></li>
            <?php else: ?>
                <li><a href="/aot-website/views/login.php">Login</a></li>
                <li><a href="/aot-website/views/register.php" class="nav-btn">Join Now</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main></main>