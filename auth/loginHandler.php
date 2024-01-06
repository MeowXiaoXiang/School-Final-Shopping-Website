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

// 查詢資料庫中的用戶資訊
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 驗證密碼
if (password_verify($password, $user['password'])) {
    // 密碼正確，將用戶資訊存入 session
    $_SESSION['username'] = $user['username'];
    $_SESSION['userid'] = $user['id'];
    echo json_encode(['success' => true]);
} else {
    // 密碼錯誤
    echo json_encode(['success' => false, 'message' => '帳號或密碼錯誤']);
}
?>