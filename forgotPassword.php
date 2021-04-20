<?php

session_start();
ob_start();
if ( isset( $_SESSION['user_id'] ) ) {
    header("Location: ./portalScreen.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Forgot Password</b></h1>
    <hr>
    <br>



    <div class="container">

    <?php
    if(strlen($_COOKIE["message"])>1) {
        if (strpos($_COOKIE["message"],"Sent")){
            printf("<h1 class=\"text-center text-success\">%s</h1>",$_COOKIE["message"]);
        }else{
            printf("<h1 class=\"text-center text-danger\">%s</h1>",$_COOKIE["message"]);
        }
    }
    setcookie("message", "", time() + (30),"/");
    $_COOKIE=Array();
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }

    ?>

    <h6>Please Enter your Secret Question and Answer to receive your password in the mail</h6>
    <br>

    <form action="./doForgotPassword.php" method="POST">
        <label for="username">USERNAME or EMAIL: </label>
        <input type="text" placeholder="Username/Email" id="username" name="username" required><br><br>

        <label for="secQ">Security Question: </label>
        <input type="secQ" name="secQ" id="secQ" placeholder="Security Question" required><br><br>

        <label for="ans">Answer: </label>
        <input type="ans" name="ans" id="ans" placeholder="Security Answer" required><br><br>
        <br>
        <button type="submit" class="btn btn-success button1">Submit</button>
    </form>
    
    

    </div>
    



</body>

</html>