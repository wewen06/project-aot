<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') die("Akses ditolak");
require_once '../config/database.php';
$stmt = $pdo->prepare("UPDATE characters SET name=?, affiliation=?, rank=?, image_url=? WHERE id=?");
$stmt->execute([$_POST['name'], $_POST['affiliation'], $_POST['rank'], $_POST['image_url'], $_POST['id']]);
header("Location: ../views/characters.php?success=Data berhasil diupdate");
?>