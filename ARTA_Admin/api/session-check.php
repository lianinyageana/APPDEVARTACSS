<?php
session_start();
header('Content-Type: application/json');
$loggedIn = isset($_SESSION['admin_user_id']) && !empty($_SESSION['admin_user_id']);
echo json_encode(['logged' => $loggedIn, 'user' => $_SESSION['admin_username'] ?? null]);
