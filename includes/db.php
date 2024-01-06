<?php
$conn = new mysqli('127.0.0.1', 'root', '123456', 'uch_pchome');
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
?>