<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback and Contact</title>
  <link rel="stylesheet" href="stylefb.css">
</head>
<body>
    <header>
      <img src="../webAssets/valenzuela_logo.png" alt="Valenzuela Logo" class="logo">
      <div>
        <h2 class="textHeaderh2">CITY GOVERNMENT OF VALENZUELA</h2>
        <p class="textHeader">Tuloy ang Progreso, Valenzuela!</p>
      </div>
    </header>
    <a href="../surverForm1/secondpage.php" class="back-link">
      <img src="../webAssets/backIcon.png" class="backIcon">
      <p>Go back</p>
    </a>
  <div class="container">
    <h1>Feedback and Contact</h1>
    <p>Suggest how we can improve our services (optional)</p>

    <form action="submit_feedback.php" method="post" id="feedback-form">
      <div class="question-box">
        <textarea name="feedback" rows="5" placeholder="Please type your feedback here..."></textarea>

        <div class="checkbox-group">
          <label>
            <input type="checkbox" name="receive_copy"> 
            Do you want to receive a personal copy of your response?
          </label>
        </div>

        <div class="contact-fields">
          <input type="email" name="email" placeholder="Email address (optional)">
          <input type="tel" name="phone" placeholder="Phone number (optional)">
        </div>
      </div>

      <div class="footer">
        <button type="submit" class="submit-btn">Submit</button>
        <p class="page-indicator">4/4</p>
      </div>
    </form>
  </div>
    <footer>
      <img src="../webAssets/valenzuelife.png" alt="This is the life Valenzuela!" class="footer-logo">
    </footer>
</body>
</html>
