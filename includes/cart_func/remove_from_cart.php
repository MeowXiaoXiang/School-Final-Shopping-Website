<?php
session_start();
include('../db.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['userid']) || !isset($_POST['product_id'])) {
    echo json_encode(['success' => false, 'message' => '缺少必要的參數']);
    exit;
}

$userId = $_SESSION['userid'];
$productId = $_POST['product_id'];

$sql = "SELECT id FROM carts WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cartId = $row['id'];

$sql = "DELETE FROM cart_items WHERE cart_id = $cartId AND product_id = $productId";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}
?>