<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../db_connect.php';

$conn->set_charset('utf8mb4');

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
  echo "<script>alert('Please enter username and password.'); window.history.back();</script>";
  exit;
}

try {
  $stmt = $conn->prepare('SELECT id, username, password FROM auth WHERE username = ? LIMIT 1');
  if (!$stmt) {
    throw new Exception('Prepare failed: ' . $conn->error);
  }
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $stored = (string)$row['password'];
    if (hash_equals($stored, $password)) {
      session_regenerate_id(true);
      $_SESSION['admin_user_id'] = (int)$row['id'];
      $_SESSION['admin_username'] = $row['username'];
      header('Location: ../admin-dashboard.html');
      exit;
    }
  }

  echo "<script>alert('Invalid username or password.'); window.history.back();</script>";
} catch (Throwable $e) {
  echo "<script>alert('Login error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES) . "'); window.history.back();</script>";
} finally {
  if (isset($stmt)) { $stmt->close(); }
  $conn->close();
}
