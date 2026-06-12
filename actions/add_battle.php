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
$image_url = '';

if(empty($name)) {
    header("Location: ../views/battles.php?error=Nama pertempuran tidak boleh kosong");
    exit();
}

// Upload gambar
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../assets/uploads/battles/';
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];

    if(in_array($ext, $allowed)) {
        $filename = uniqid('battle_') . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_url = 'assets/uploads/battles/' . $filename;
        }
    }
}

$stmt = $pdo->prepare("INSERT INTO battles (name, location, winner, date, image_url) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$name, $location, $winner, $date, $image_url]);

header("Location: ../views/battles.php?success=Pertempuran $name berhasil ditambahkan!");
exit();
?>