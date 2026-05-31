<?php
session_start();
require_once '../config/database.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->execute([$username, $password]);
$user = $stmt->fetch();

if($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    
    if($user['role'] == 'admin') {
        header("Location: ../views/dashboard_admin.php");
    } else {
        header("Location: ../views/dashboard_user.php");
    }
} else {
    header("Location: ../views/login.php?error=1");
}
exit();
?>