<?php

session_start();
ob_start();

?>
<html>

<head>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
    <title>Quick Links</title>
</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>QUICK LINKS &gt;&gt;</b></h1>

    <form>

        <?php
            if(!isset($_SESSION['user_id'])){
              echo<<<LOL

              <input type="radio" id="Register" name="Options" value="./register.php">
              <label for="Register">Register</label><br>
      
              <input type="radio" id="Login" name="Options" value="./login.php">
              <label for="Login">Login</label><br>

              LOL;
            }
            else{
              echo<<<EOL

              <input type="radio" id="Logout" name="Options" value="./doLogout.php">
              <label for="Logout">Logout</label><br>

              <input type="radio" id="User Profile" name="Options" value="./userProfile.php">
              <label for="User Profile">User Profile</label><br>

              <input type="radio" id="Report a Problem" name="Options" value="./userReport.php">
              <label for="Report a Problem">Report a Problem</label><br>

              <input type="radio" id="Reports" name="Options" value="./reports.php">
              <label for="Reports">Reports</label><br>

              <input type="radio" id="Suggest" name="Options" value="./suggest.php">
              <label for="Suggest">Suggest</label><br>

              <input type="radio" id="Vote" name="Options" value="./vote.php">
              <label for="Vote">Vote</label><br>

              <input type="radio" id="Survey" name="Options" value="./survey.php">
              <label for="Vote">Survey</label><br>

              EOL;
              if($_SESSION['role']=='official'){
                echo<<<OFFICIAL
                <input type="radio" id="allReports" name="Options" value="./allReports.php">
                <label for="allReports">All Reports</label><br>
                OFFICIAL;
              }
            }
        ?>

        <input type="radio" id="FAQ" name="Options" value="./FAQ.php">
        <label for="FAQ">FAQ</label><br>

        <input type="radio" id="Contact Us" name="Options" value="./contact.php">
        <label for="Contact Us">Contact Us</label><br>

        <button type="button" class="btn btn-primary" onclick="window.location = document.querySelector('input[type=radio]:checked').value;">Go</button>
        <br>
        <br>
        

        <img src="img1.jpg" title="" width="25%" height="35%">
        <img src="img2.jpg" width="35%" height="35%">

        <br>
        <br>
        



        <h4>Keeping our city clean and safe</h4>
        <button type="button" class="btn btn-info float-right" onclick="prompt('Please enter your friend\'s Email:','Email Address');">Share Cypress With Others</button>


    </form>
</body>

</html>