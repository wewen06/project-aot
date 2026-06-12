<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("⛔ Akses ditolak. Hanya admin!");
}
require_once '../config/database.php';

$title = $_POST['title'];
$season = $_POST['season'] ?? 0;
$episode_number = $_POST['episode_number'] ?? 0;
$air_date = $_POST['air_date'] ?? '';
$image_url = '';

if(empty($title)) {
    header("Location: ../views/episodes.php?error=Judul episode tidak boleh kosong");
    exit();
}

// Upload gambar
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
            $image_url = 'assets/uploads/episodes/' . $filename;
        }
    }
}

$stmt = $pdo->prepare("INSERT INTO episodes (title, season, episode_number, air_date, image_url) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$title, $season, $episode_number, $air_date, $image_url]);

header("Location: ../views/episodes.php?success=Episode $title berhasil ditambahkan!");
exit();
?>