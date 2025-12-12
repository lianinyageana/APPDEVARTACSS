<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Automation of ARTA Compliant Satisfactory Survey</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylelp.css"> 
    </head>

    <body>
        <header>
            <div class="header-left">
                <img src="../webAssets/valenzuela_logo.png" alt="Logo" class="logo">
                <div class="header-text">
                <h3>CITY GOVERNMENT OF VALENZUELA</h3>
                <p>Tuloy ang Progreso, Valenzuela!</p>
                </div>
            </div>
            <button class="admin-btn" onclick="adminLogin()">Admin login</button>
        </header>

    <main>
      <div class="icon">
      </div>
      <img src="../webAssets/surveyIcon.png" alt="survey_icon1" class="logo">
      <h1>Automation of ARTA-Compliant<br>Customer Satisfaction Survey</h1>

      <p class="desc">
        Good day Valenzuelano! Thank you for accessing our services.<br>
        Can you take a little bit of your time in answering our quick survey?<br>
        This survey will help the city government in assessing further what the city needs.
      </p>

       <a href="../clientPage/clientform.php"> <button type="button" id="nextBtn" class="take-btn">Start Survey</button></a>

      <p class="disclaimer">
        By answering this survey, you agree to the collection and use of your information under the Data Privacy Act of 2012.
        Your answers will be kept private and used only for research purposes.
      </p>
  </main>

  <script src="script.js"></script>

    </body>
</html>