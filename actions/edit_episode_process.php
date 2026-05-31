<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$stmt = $pdo->prepare("UPDATE episodes SET title=?, season=?, episode_number=?, air_date=? WHERE id=?");
$stmt->execute([
    $_POST['title'],
    $_POST['season'],
    $_POST['episode_number'],
    $_POST['air_date'],
    $_POST['id']
]);

header("Location: ../views/episodes.php?success=Data episode berhasil diupdate");
exit();
?>