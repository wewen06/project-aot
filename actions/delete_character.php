<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') die("Akses ditolak");
require_once '../config/database.php';
$stmt = $pdo->prepare("DELETE FROM characters WHERE id=?");
$stmt->execute([$_GET['id']]);
header("Location: ../views/characters.php?success=Karakter dihapus");
?>