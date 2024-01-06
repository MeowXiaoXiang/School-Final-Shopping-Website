<?php
session_start();

// 清除 session
unset($_SESSION['username']);
unset($_SESSION['userid']);

// 重定向到首頁
header('Location: ../index.php');
exit;
?>