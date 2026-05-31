<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM battles WHERE id=?");
$stmt->execute([$id]);

header("Location: ../views/battles.php?success=Pertempuran berhasil dihapus");
exit();
?>