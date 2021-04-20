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
    <title>Login Here</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Login</b></h1>
    <hr>
    <br>

    <b>
        You are currently at the Cypress Login Page. By Logging into this system,
        you will be able to report a variety of problems as you have witnessed on the streets
        of Toronto.
    </b>
    <?php
    if(strlen($_COOKIE["message"])>1) {
        if (strpos($_COOKIE["message"],"Created")){
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

    <br>
    <br>
    <br>

    <form action="./doLogin.php" method="POST">
        <label for="username">USERNAME: </label>
        <input type="text" placeholder="username" id="xyz" name="username">
        <label for="password"><br><br>PASSWORD: </label>
        <input type="password" placeholder="password" id="password" name="password">
        <br><br>
        <button class="btn btn-success button1">Login</button>
    </form>

    <br>
    <br>
    <button class="btn btn-warning" onclick="location.href='./forgotPassword.php'">Forgot Password</button>

</body>

</html>