<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connect.php';
$conn->set_charset('utf8mb4');

try {
    $result = $conn->query("SELECT id, client_type, date_accomplished, age, sex, services_availed, feedback, email FROM survey_responses ORDER BY id DESC LIMIT 200");
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $rows]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
$conn->close();
