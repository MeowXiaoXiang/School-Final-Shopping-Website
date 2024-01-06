<?php
session_start();

// 匯入資料庫連線程式碼
require_once '../includes/db.php';

// 讀取原始的 POST 數據
$json = file_get_contents('php://input');

// 解析 JSON 數據
$data = json_decode($json, true);

// 獲取用戶輸入的帳號和密碼
$username = $data['username'];
$password = $data['password'];

// 檢查帳號是否已存在
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // 帳號已存在
    echo json_encode(['success' => false, 'message' => '帳號已存在']);
    exit;
}

// 將密碼加密
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 將新用戶資訊存入資料庫
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $hashedPassword);
$stmt->execute();

// 將新用戶資訊存入 session
$_SESSION['username'] = $username;
$_SESSION['userid'] = $conn->insert_id;

echo json_encode(['success' => true]);
?>