<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['client_type'] = $_POST['client_type'] ?? $_SESSION['client_type'] ?? '';
  $_SESSION['date_accomplished'] = $_POST['date_accomplished'] ?? $_SESSION['date_accomplished'] ?? '';
  $_SESSION['age'] = $_POST['age'] ?? $_SESSION['age'] ?? '';
  $_SESSION['sex'] = $_POST['sex'] ?? $_SESSION['sex'] ?? '';
  $_SESSION['services_availed'] = $_POST['services_availed'] ?? $_SESSION['services_availed'] ?? '';
  $_SESSION['cc1'] = $_POST['cc1'] ?? $_SESSION['cc1'] ?? '';
  $_SESSION['cc2'] = $_POST['cc2'] ?? $_SESSION['cc2'] ?? '';
  $_SESSION['cc3'] = $_POST['cc3'] ?? $_SESSION['cc3'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citizen’s Charter Questions</title>
  <link rel="stylesheet" href="../surveyForm1/styles.css">
</head>
<body>
<header>
  <img src="../webAssets/valenzuela_logo.png" alt="Valenzuela Logo" class="logo">
  <div>
    <h2 class="textHeaderh2">CITY GOVERNMENT OF VALENZUELA</h2>
    <p class="textHeader">Tuloy ang Progreso, Valenzuela!</p>
  </div>
</header>

<a href="../surveyForm1/firstpage.php" class="back-link">
  <img src="../webAssets/backIcon.png" class="backIcon">
  <p>Go back</p>
</a>

<div class="container">
  <h1 class="formTextHeaderh2">Citizen’s Charter Questions</h1>
  <p class="formTextHeaderp">Just choose the circle that corresponds to your answer.</p>

  <form id="cc-form" action="../feedbackForm/feedback.php" method="post">
    <?php 
    $questions = [
      "SQD0. I am satisfied with the service I availed.",
      "SQD1. I spent a reasonable amount of time for my transaction.",
      "SQD2. The office followed the transaction’s requirements and steps based on the information provided.",
      "SQD3. The fees (including payment) I needed to do were easy and simple.",
      "SQD4. I easily found information about my transaction from the office or its website.",
      "SQD5. The staff were knowledgeable and capable.",
      "SQD6. The office was clean and organized during my transaction.",
      "SQD7. I was treated courteously and professionally by the staff.",
      "SQD8. I got what I needed or, if denied, the reason was clearly explained."
    ];

    $choices = ["Strongly Agree", "Agree", "Neither", "Disagree", "Strongly Disagree"];

    for ($i = 0; $i < count($questions); $i++): ?>
      <div class="question-box">
        <p><strong><?= $questions[$i]; ?></strong></p>
        <div class="sqdAnswer">
          <?php foreach ($choices as $index => $label): ?>
            <label>
              <input type="radio" name="sqd<?= $i ?>" value="<?= $index + 1 ?>" required> <?= $label ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endfor; ?>

    <div class="footer">
      <button type="submit" id="nextBtn">Next page</button>
      <p class="page-indicator">3/4</p>
    </div>
  </form>
</div>

<footer>
  <img src="../webAssets/valenzuelife.png" alt="This is the life Valenzuela!" class="footer-logo">
</footer>
</body>
</html>
