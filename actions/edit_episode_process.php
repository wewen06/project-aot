<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak!");
}
require_once '../config/database.php';

$id = $_POST['id'];
$image_url = $_POST['old_image_url'] ?? '';

if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../assets/uploads/episodes/';
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];

    if(in_array($ext, $allowed)) {
        $filename = uniqid('ep_') . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            if(!empty($image_url) && str_starts_with($image_url, 'assets/uploads/')) {
                $oldPath = '../' . $image_url;
                if(file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $image_url = 'assets/uploads/episodes/' . $filename;
        }
    }
}

$stmt = $pdo->prepare("UPDATE episodes SET title=?, season=?, episode_number=?, air_date=?, image_url=? WHERE id=?");
$stmt->execute([
    $_POST['title'],
    $_POST['season'],
    $_POST['episode_number'],
    $_POST['air_date'],
    $image_url,
    $id
]);

header("Location: ../views/episodes.php?success=Data episode berhasil diupdate");
exit();
?>