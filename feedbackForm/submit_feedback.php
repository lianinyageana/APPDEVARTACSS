<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'arta_survey');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_type = $_SESSION['client_type'] ?? '';
$date_accomplished = $_SESSION['date_accomplished'] ?? '';
$age = $_SESSION['age'] ?? '';
$sex = $_SESSION['sex'] ?? '';
$services_availed = $_SESSION['services_availed'] ?? '';

$cc1 = $_SESSION['cc1'] ?? '';
$cc2 = $_SESSION['cc2'] ?? '';
$cc3 = $_SESSION['cc3'] ?? '';

$sqd_answers = [];
for ($i = 0; $i <= 8; $i++) {
    $sqd_answers[] = $_SESSION["sqd$i"] ?? '';
}

$feedback = $_POST['feedback'] ?? '';
$receive_copy = isset($_POST['receive_copy']) ? 1 : 0;
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$sql = "INSERT INTO survey_responses (
    client_type, date_accomplished, age, sex, services_availed,
    cc1, cc2, cc3,
    sqd0, sqd1, sqd2, sqd3, sqd4, sqd5, sqd6, sqd7, sqd8,
    feedback, receive_copy, email, phone
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssissssssssssssssssis",
    $client_type,
    $date_accomplished,
    $age,
    $sex,
    $services_availed,
    $cc1,
    $cc2,
    $cc3,
    $sqd_answers[0],
    $sqd_answers[1],
    $sqd_answers[2],
    $sqd_answers[3],
    $sqd_answers[4],
    $sqd_answers[5],
    $sqd_answers[6],
    $sqd_answers[7],
    $sqd_answers[8],
    $feedback,
    $receive_copy,
    $email,
    $phone
);

if ($stmt->execute()) {
    if ($receive_copy === 1 && !empty($email)) {
        $subject = 'Copy of your ARTA survey response';
        $message = "Thank you for completing the ARTA survey. Here is a summary of your response:\r\n\r\n" .
            "Date: " . ($date_accomplished ?: date('Y-m-d')) . "\r\n" .
            "Client Type: $client_type\r\n" .
            "Age: $age\r\n" .
            "Sex: $sex\r\n" .
            "Services Availed: $services_availed\r\n\r\n" .
            "Core Commitments:\r\n" .
            "  CC1: $cc1\r\n" .
            "  CC2: $cc2\r\n" .
            "  CC3: $cc3\r\n\r\n" .
            "Satisfaction Questions (SQD0-8):\r\n" .
            "  SQD0: {$sqd_answers[0]}\r\n" .
            "  SQD1: {$sqd_answers[1]}\r\n" .
            "  SQD2: {$sqd_answers[2]}\r\n" .
            "  SQD3: {$sqd_answers[3]}\r\n" .
            "  SQD4: {$sqd_answers[4]}\r\n" .
            "  SQD5: {$sqd_answers[5]}\r\n" .
            "  SQD6: {$sqd_answers[6]}\r\n" .
            "  SQD7: {$sqd_answers[7]}\r\n" .
            "  SQD8: {$sqd_answers[8]}\r\n\r\n" .
            "Feedback:\r\n" . ($feedback ?: 'N/A') . "\r\n\r\n" .
            "If you did not request this copy or have questions, please contact the office.";

        $headers = 'From: no-reply@yourdomain.local' . "\r\n" .
                   'Reply-To: no-reply@yourdomain.local' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        @mail($email, $subject, $message, $headers);
    }

    echo "<script>alert('Thank you for completing the survey!'); window.location.href='../landingPage/landing.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

session_destroy();
?>
