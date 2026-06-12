<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya admin!");
}
require_once '../config/database.php';

$name = $_POST['name'];
$affiliation = $_POST['affiliation'] ?? '';
$rank = $_POST['rank'] ?? '';
$image_url = '';

if(empty($name)) {
    header("Location: ../views/characters.php?error=Nama karakter tidak boleh kosong");
    exit();
}

// Upload gambar
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../assets/uploads/characters/';
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];

    if(in_array($ext, $allowed)) {
        $filename = uniqid('char_') . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_url = 'assets/uploads/characters/' . $filename;
        }
    }
}

$stmt = $pdo->prepare("INSERT INTO characters (name, affiliation, rank, image_url) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $affiliation, $rank, $image_url]);

header("Location: ../views/characters.php?success=Karakter $name berhasil ditambahkan!");
exit();
?>