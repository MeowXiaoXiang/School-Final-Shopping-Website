<?php
session_start();
include('../db.php');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['items' => []]);
    exit;
}

$userId = $_SESSION['userid'];

$sql = "SELECT products.id, products.name, products.price, cart_items.quantity FROM cart_items 
        JOIN carts ON cart_items.cart_id = carts.id 
        JOIN products ON cart_items.product_id = products.id 
        WHERE carts.user_id = $userId";
$result = mysqli_query($conn, $sql);

$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

echo json_encode(['items' => $items]);
?>