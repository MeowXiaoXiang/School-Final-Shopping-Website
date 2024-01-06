<?php
session_start();
include('../db.php');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['quantity' => 0]);
    exit;
}

$userId = $_SESSION['userid'];

$sql = "SELECT SUM(quantity) as quantity FROM cart_items JOIN carts ON cart_items.cart_id = carts.id WHERE carts.user_id = $userId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo json_encode(['quantity' => $row['quantity'] ?? 0]);
?>