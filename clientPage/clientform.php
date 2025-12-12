<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ARTA-Compliant Survey Form</title>
  <link rel="stylesheet" href="../clientPage/stylecf.css">
</head>

<header>
  <img src="../webAssets/valenzuela_logo.png" alt="Valenzuela Logo" class="logo">
  <div>
    <h2 class="textHeaderh2">CITY GOVERNMENT OF VALENZUELA</h2>
    <p class="textHeader">Tuloy ang Progreso, Valenzuela!</p>
  </div>
</header>

<body class="form-page"> 
  <a href="../landingPage/landing.php" class="back-link">
      <img src="../webAssets/backIcon.png" class="backIcon">
      <p>Go back</p>
  </a>

  <main class="form-container">
    <h1 class="textHeaderh2">First, we want to know who you are</h1>
    <p>Just answer these questions to proceed to next steps.</p>

    <form action="../surveyForm1/firstpage.php" method="POST" class="survey-box">
      <div class="form-group">
        <label><strong>Client Type</strong></label><br>
        <label><input type="radio" name="client_type" value="Citizen" required> Citizen</label>
        <label><input type="radio" name="client_type" value="Business Owner"> Business Owner</label>
        <label><input type="radio" name="client_type" value="Government employee"> Government employee</label>
      </div>

      <div class="form-row">
        <div class="form-field">
          <label><strong>Date Accomplished</strong></label>
          <input type="date" name="date_accomplished" required>
        </div>
        <div class="form-field">
          <label><strong>Age</strong></label>
          <input type="number" name="age" min="1" required>
        </div>
      </div>

      <div class="form-group">
        <label><strong>Sex</strong></label><br>
        <label><input type="radio" name="sex" value="Male" required> Male</label>
        <label><input type="radio" name="sex" value="Female"> Female</label>
      </div>

      <div class="form-field">
        <label><strong>Services Availed</strong></label>
        <select name="services_availed" required>
          <option value="">Select a service</option>
          <option value="Business Permit">Business Permit</option>
          <option value="Health Services">Health Services</option>
          <option value="Civil Registration">Civil Registration</option>
          <option value="Barangay Clearance">Barangay Clearance</option>
        </select>
      </div>

      <button type="submit" id="nextBtn">Next page</button>

      <div class="progress">
        <span>1/4</span>
        <div class="bar"><div class="fill" style="width: 25%;"></div></div>
      </div>
    </form>
  </main>

  <script src="script.js"></script>
</body>

<footer>
  <img src="../webAssets/valenzuelife.png" alt="This is the life Valenzuela!" class="footer-logo">
</footer>

</html>
