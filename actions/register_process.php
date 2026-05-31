<?php
require_once '../config/database.php';

if($_POST['password'] != $_POST['confirm_password']) {
    header("Location: ../views/register.php?error=Password tidak cocok");
    exit();
}

$username = trim($_POST['username']);
$password = md5($_POST['password']);
$role = 'user';

// Cek username sudah dipakai?
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
if($stmt->rowCount() > 0) {
    header("Location: ../views/register.php?error=Username sudah terdaftar");
    exit();
}

// Simpan user baru
$stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->execute([$username, $password, $role]);

header("Location: ../views/login.php?message=registered");
exit();
?>