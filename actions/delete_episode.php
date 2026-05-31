<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM episodes WHERE id=?");
$stmt->execute([$id]);

header("Location: ../views/episodes.php?success=Episode berhasil dihapus");
exit();
?>