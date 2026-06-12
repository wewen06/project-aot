<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$id = $_POST['id'];
$image_url = $_POST['old_image_url'] ?? '';

// Kalau ada file baru diupload
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
            // Hapus gambar lama kalau ada dan merupakan file upload lokal
            if(!empty($image_url) && str_starts_with($image_url, 'assets/uploads/')) {
                $oldPath = '../' . $image_url;
                if(file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $image_url = 'assets/uploads/characters/' . $filename;
        }
    }
}

$stmt = $pdo->prepare("UPDATE characters SET name=?, affiliation=?, `rank`=?, image_url=? WHERE id=?");
$stmt->execute([
    $_POST['name'],
    $_POST['affiliation'],
    $_POST['rank'],
    $image_url,
    $id
]);

header("Location: ../views/characters.php?success=Character updated!");
exit();
?>