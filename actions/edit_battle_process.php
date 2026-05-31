<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$stmt = $pdo->prepare("UPDATE battles SET name=?, location=?, winner=?, date=? WHERE id=?");
$stmt->execute([
    $_POST['name'],
    $_POST['location'],
    $_POST['winner'],
    $_POST['date'],
    $_POST['id']
]);

header("Location: ../views/battles.php?success=Data pertempuran berhasil diupdate");
exit();
?>