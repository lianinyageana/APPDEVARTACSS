<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['client_type'] = $_POST['client_type'] ?? '';
    $_SESSION['date_accomplished'] = $_POST['date_accomplished'] ?? '';
    $_SESSION['age'] = $_POST['age'] ?? '';
    $_SESSION['sex'] = $_POST['sex'] ?? '';
    $_SESSION['services_availed'] = $_POST['services_availed'] ?? '';
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

  <a href="../landingPage/landing.php" class="back-link">
    <img src="../webAssets/backIcon.png" class="backIcon">
    <p>Go back</p>
  </a>

  <div class="container">
    <h1 class="formTextHeaderh2">Citizen’s Charter Questions</h1>
    <p class="formTextHeaderp">Just choose the circle that corresponds to your answer.</p>

    <form id="cc-form" action="../surveyForm1/secondpage.php" method="post">
      <div class="question-box">
        <p><strong>CC1. Which of the following best describes your awareness of a CC?</strong></p>
        <label><input type="radio" name="cc1" value="1" required> I know what a CC is and I saw this office’s CC.</label>
        <label><input type="radio" name="cc1" value="2"> I know what a CC is but I did not see this office’s CC.</label>
        <label><input type="radio" name="cc1" value="3"> I learned of the CC only when I saw this office’s CC.</label>
        <label><input type="radio" name="cc1" value="4"> I do not know what a CC is and I did not see one in this office.</label>
      </div>

      <div class="question-box">
        <p><strong>CC2. If aware of CC (answered 1–3 on CC1), would you say that the CC of this office was?</strong></p>
        <label><input type="radio" name="cc2" value="1" required> Easy to see</label>
        <label><input type="radio" name="cc2" value="2"> Somewhat easy to see</label>
        <label><input type="radio" name="cc2" value="3"> Difficult to see</label>
        <label><input type="radio" name="cc2" value="4"> Not applicable</label>
      </div>

      <div class="question-box">
        <p><strong>CC3. If aware of CC (answered 1–3 on CC1), how much did the CC help you in this transaction?</strong></p>
        <label><input type="radio" name="cc3" value="1" required> Very helpful</label>
        <label><input type="radio" name="cc3" value="2"> Somewhat helpful</label>
        <label><input type="radio" name="cc3" value="3"> Not helpful</label>
        <label><input type="radio" name="cc3" value="4"> Not applicable</label>
      </div>

      <div class="footer">
        <button type="submit" id="nextBtn">Next page</button>
        <p class="page-indicator">2/4</p>
      </div>
    </form>
  </div>

  <script src="script.js"></script>
</body>
<footer>
  <img src="../webAssets/valenzuelife.png" alt="This is the life Valenzuela!" class="footer-logo">
</footer>
</html>
