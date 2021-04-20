<?php

session_start();
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>FAQ Page</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
    <style>
    .center {
        text-align: center;
    }

    .title1 {
        font-weight: bold;
        float: left;
    }

    .title2 {
        font-weight: bold;
        float: right;
    }

    .button {
        font: bold 11px Arial;
        text-decoration: none;
        background-color: #eeeeee;
        color: #333333;
        padding: 2px 6px 2px 6px;
        border-top: 1px solid #cccccc;
        border-right: 1px solid #333333;
        border-bottom: 1px solid #333333;
        border-left: 1px solid #cccccc;
    }

    .home {
        float: left;
    }
    </style>
</head>

<body style="background-color: antiquewhite">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Frequently Asked Questions</b></h1>
    <hr>

    <p><h3>What is the purpose of this website?</h3></p>
    <p>
      This website is designed to help us in resolving city issues as quick as possible<br>
      after receiving your report(s). Our goal is to achieve a more sustainable city.
    </p>

    <p><h3>What should I do if I cannot successfully login?</h3></p>
    <p>
      For login troubleshoot, please contact us at <a href="mailto: support@fakecypress.com">support@fakecypress.com</a>
    </p>

    <p><h3>How can I change my account information?</h3></p>
    <p>On the portal page, click on the "User Profile" button and click "Go".<br>There you will see a button to edit your information.</p>

    <p><h3>How to delete my account?</h3></p>
    <p>Click on the "User Profile" button and a "Delete Account" button can be found on the bottom part of the screen</p>

    <p><h3>What if I cannot find the type of problem I wanted to report?</h3></p>
    <p>
      Click on the "Suggest" button and leave your report there or you may contact us through our email at 
      <a href="mailto: support@fakecypress.com">support@fakecypress.com</a>
    </p>

    <p><h3>Is it possible to cancel a report?</h3></p>
    <p>Yes, to cancel a report, click on the "Reports" button. There will be an option to delete the report(s) you submitted.</p>
    
    <p><h3>Where do I go to see my report(s) history?</h3></p>
    <p>Go to the "Reports" button and you will see all the report(s) you made.</p>

    <br>
    <br>

    <p>
      Don't see your questions here? Not to worry, please visit our contact page 
      <a href="./contact.php">here</a>
       for our informations
    </p>

</body>

</html>