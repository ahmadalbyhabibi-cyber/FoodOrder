<?php
require_once __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: menu.php'); exit; }
$product_id = (int)$_POST['product_id'];
$qty = max(1, (int)$_POST['qty']);
// fetch product
$res = $mysqli->query("SELECT id,title,price FROM products WHERE id=$product_id");
if (!$res || !$res->num_rows) { header('Location: menu.php'); exit; }
$product = $res->fetch_assoc();
// use session cart
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['qty'] += $qty;
} else {
    $_SESSION['cart'][$product_id] = ['id'=>$product['id'],'title'=>$product['title'],'price'=>$product['price'],'qty'=>$qty];
}
header('Location: cart.php'); exit;