<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya admin!");
}
require_once '../config/database.php';

$name = $_POST['name'];
$affiliation = $_POST['affiliation'] ?? '';
$rank = $_POST['rank'] ?? '';
$image_url = $_POST['image_url'] ?? '';

if(empty($name)) {
    header("Location: ../views/characters.php?error=Nama karakter tidak boleh kosong");
    exit();
}

$stmt = $pdo->prepare("INSERT INTO characters (name, affiliation, rank, image_url) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $affiliation, $rank, $image_url]);

header("Location: ../views/characters.php?success=Karakter $name berhasil ditambahkan!");
exit();
?>