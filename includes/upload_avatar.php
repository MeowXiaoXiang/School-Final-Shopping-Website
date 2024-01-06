<?php
session_start();

// 檢查是否已經登入
if (!isset($_SESSION['userid'])) {
    http_response_code(403);
    exit;
}

// 檢查是否有檔案被上傳
if (!isset($_FILES['avatar'])) {
    http_response_code(400);
    exit;
}

// 獲取檔案和檔案類型
$file = $_FILES['avatar'];
$fileType = $file['type'];

// 檢查檔案類型是否為 jpg 或 png
if ($fileType !== 'image/jpeg' && $fileType !== 'image/png') {
    http_response_code(415);
    exit;
}

// 獲取檔案副檔名
$fileExtension = $fileType === 'image/jpeg' ? 'jpg' : 'png';

// 建立新的檔案名稱
$newFileName = $_SESSION['userid'] . '.' . $fileExtension;

// 刪除舊的 jpg 和 png 頭像
$oldJpg = '../userAvatar/' . $_SESSION['userid'] . '.jpg';
$oldPng = '../userAvatar/' . $_SESSION['userid'] . '.png';
if (file_exists($oldJpg)) {
    unlink($oldJpg);
}
if (file_exists($oldPng)) {
    unlink($oldPng);
}

// 將檔案移動到目標目錄
if (move_uploaded_file($file['tmp_name'], '../userAvatar/' . $newFileName)) {
    http_response_code(200);
} else {
    http_response_code(500);
}
?>