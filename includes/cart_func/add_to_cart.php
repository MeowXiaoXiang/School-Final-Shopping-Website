<?php
session_start();
include('../db.php');

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'];
$quantity = $data['quantity'];

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false]);
    exit;
}

$userId = $_SESSION['userid'];

$sql = "SELECT id FROM carts WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);
$cart = mysqli_fetch_assoc($result);

if (!$cart) {
    $sql = "INSERT INTO carts (user_id) VALUES ($userId)";
    mysqli_query($conn, $sql);
    $cartId = mysqli_insert_id($conn);
} else {
    $cartId = $cart['id'];
}

$sql = "SELECT * FROM cart_items WHERE cart_id = $cartId AND product_id = $productId";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($result);

if ($item) {
    $newQuantity = $item['quantity'] + $quantity;
    $sql = "UPDATE cart_items SET quantity = $newQuantity WHERE cart_id = $cartId AND product_id = $productId";
} else {
    $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES ($cartId, $productId, $quantity)";
}

mysqli_query($conn, $sql);

echo json_encode(['success' => true]);
?>