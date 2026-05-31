<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya admin!");
}
require_once '../config/database.php';

$name = $_POST['name'];
$location = $_POST['location'] ?? '';
$winner = $_POST['winner'] ?? '';
$date = $_POST['date'] ?? '';

if(empty($name)) {
    header("Location: ../views/battles.php?error=Nama pertempuran tidak boleh kosong");
    exit();
}

$stmt = $pdo->prepare("INSERT INTO battles (name, location, winner, date) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $location, $winner, $date]);

header("Location: ../views/battles.php?success=Pertempuran $name berhasil ditambahkan!");
exit();
?>