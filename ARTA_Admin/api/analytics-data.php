<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connect.php';

$conn->set_charset('utf8mb4');

$response = [
    'monthly' => ['labels' => [], 'data' => []],
    'weekly' => ['labels' => [], 'data' => []],
    'satisfaction' => [
        'labels' => ['Strongly Agree', 'Agree', 'Neither', 'Disagree', 'Strongly Disagree'],
        'data' => [0, 0, 0, 0, 0]
    ],
    'clientType' => ['labels' => [], 'data' => []],
    'sexBreakdown' => ['labels' => [], 'data' => []],
    'feedbackShare' => ['labels' => ['With feedback', 'No feedback'], 'data' => [0, 0]],
    'totals' => ['responses' => 0]
];

function runQuery(mysqli $conn, string $sql): mysqli_result {
    $result = $conn->query($sql);
    if (!$result) {
        throw new Exception('Query failed: ' . $conn->error);
    }
    return $result;
}

try {
    $totalResult = runQuery($conn, 'SELECT COUNT(*) AS total FROM survey_responses');
    $response['totals']['responses'] = (int) $totalResult->fetch_assoc()['total'];

    $monthlyResult = runQuery(
        $conn,
        "SELECT DATE_FORMAT(date_accomplished, '%Y-%m-01') AS month, COUNT(*) AS total
         FROM survey_responses
         WHERE date_accomplished IS NOT NULL AND date_accomplished <> ''
           AND DATE(date_accomplished) >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
         GROUP BY month"
    );

    $monthlyMap = [];
    while ($row = $monthlyResult->fetch_assoc()) {
        $monthKey = date('Y-m-01', strtotime($row['month']));
        $monthlyMap[$monthKey] = (int) $row['total'];
    }

    $monthCursor = new DateTime('first day of this month');
    $monthCursor->modify('-5 months');
    for ($i = 0; $i < 6; $i++) {
        $key = $monthCursor->format('Y-m-01');
        $response['monthly']['labels'][] = $monthCursor->format('M Y');
        $response['monthly']['data'][] = $monthlyMap[$key] ?? 0;
        $monthCursor->modify('+1 month');
    }

    $weeklyResult = runQuery(
        $conn,
        "SELECT DATE(date_accomplished) AS day, COUNT(*) AS total
         FROM survey_responses
         WHERE date_accomplished IS NOT NULL AND date_accomplished <> ''
           AND DATE(date_accomplished) >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
         GROUP BY day"
    );

    $weeklyMap = [];
    while ($row = $weeklyResult->fetch_assoc()) {
        $weeklyMap[$row['day']] = (int) $row['total'];
    }

    $dayCursor = new DateTime('today');
    $dayCursor->modify('-6 days');
    for ($i = 0; $i < 7; $i++) {
        $key = $dayCursor->format('Y-m-d');
        $response['weekly']['labels'][] = $dayCursor->format('D');
        $response['weekly']['data'][] = $weeklyMap[$key] ?? 0;
        $dayCursor->modify('+1 day');
    }

    $satisfactionResult = runQuery(
        $conn,
        "SELECT score, COUNT(*) AS total FROM (
            SELECT sqd0 AS score FROM survey_responses
            UNION ALL SELECT sqd1 FROM survey_responses
            UNION ALL SELECT sqd2 FROM survey_responses
            UNION ALL SELECT sqd3 FROM survey_responses
            UNION ALL SELECT sqd4 FROM survey_responses
            UNION ALL SELECT sqd5 FROM survey_responses
            UNION ALL SELECT sqd6 FROM survey_responses
            UNION ALL SELECT sqd7 FROM survey_responses
            UNION ALL SELECT sqd8 FROM survey_responses
        ) AS scores
        WHERE score IS NOT NULL AND score <> ''
        GROUP BY score"
    );

    $satisfactionMap = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    while ($row = $satisfactionResult->fetch_assoc()) {
        $index = (int) $row['score'];
        if (isset($satisfactionMap[$index])) {
            $satisfactionMap[$index] = (int) $row['total'];
        }
    }
    $response['satisfaction']['data'] = array_values($satisfactionMap);

    $clientResult = runQuery(
        $conn,
        "SELECT client_type AS label, COUNT(*) AS total
         FROM survey_responses
         WHERE client_type IS NOT NULL AND client_type <> ''
         GROUP BY client_type
         ORDER BY total DESC"
    );
    while ($row = $clientResult->fetch_assoc()) {
        $response['clientType']['labels'][] = $row['label'];
        $response['clientType']['data'][] = (int) $row['total'];
    }

    $sexResult = runQuery(
        $conn,
        "SELECT sex AS label, COUNT(*) AS total
         FROM survey_responses
         WHERE sex IS NOT NULL AND sex <> ''
         GROUP BY sex"
    );
    while ($row = $sexResult->fetch_assoc()) {
        $response['sexBreakdown']['labels'][] = $row['label'];
        $response['sexBreakdown']['data'][] = (int) $row['total'];
    }

    $feedbackResult = runQuery(
        $conn,
        "SELECT
            SUM(CASE WHEN feedback IS NOT NULL AND feedback <> '' THEN 1 ELSE 0 END) AS with_feedback,
            SUM(CASE WHEN feedback IS NULL OR feedback = '' THEN 1 ELSE 0 END) AS without_feedback
         FROM survey_responses"
    );
    $feedbackRow = $feedbackResult->fetch_assoc();
    $response['feedbackShare']['data'] = [
        (int) $feedbackRow['with_feedback'],
        (int) $feedbackRow['without_feedback']
    ];

    echo json_encode(['success' => true, 'data' => $response]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Unable to load analytics data',
        'detail' => $e->getMessage()
    ]);
}

$conn->close();
?>
