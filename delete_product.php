<?php
require_once __DIR__ . '/../config.php';
if (!isLoggedIn() || !isAdmin($mysqli)) { header('Location: ../login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $mysqli->query("DELETE FROM products WHERE id=$id");
}
header('Location: dashboard.php');
exit;