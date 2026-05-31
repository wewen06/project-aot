<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya admin!");
}
require_once '../config/database.php';

$title = $_POST['title'];
$season = $_POST['season'] ?? 0;
$episode_number = $_POST['episode_number'] ?? 0;
$air_date = $_POST['air_date'] ?? '';

if(empty($title)) {
    header("Location: ../views/episodes.php?error=Judul episode tidak boleh kosong");
    exit();
}

$stmt = $pdo->prepare("INSERT INTO episodes (title, season, episode_number, air_date) VALUES (?, ?, ?, ?)");
$stmt->execute([$title, $season, $episode_number, $air_date]);

header("Location: ../views/episodes.php?success=Episode $title berhasil ditambahkan!");
exit();
?>