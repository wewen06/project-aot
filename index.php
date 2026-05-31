<?php
session_start();

if(isset($_SESSION['user_id'])) {
    if($_SESSION['role'] == 'admin') {
        header("Location: views/dashboard_admin.php");
    } else {
        header("Location: views/dashboard_user.php");
    }
} else {
    header("Location: views/login.php");
}
exit();
?>