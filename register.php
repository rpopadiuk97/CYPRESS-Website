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
    <title>Register Here</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Register</b></h1>
    <hr>
    <?php
    if(strlen($_COOKIE["message"])>1) {
        printf("<h1 class=\"text-center text-danger\">%s</h1>",$_COOKIE["message"]);
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

    <b>
        Please enter information below: <br>
        Please note: Username and Password are case sensitive
    </b>

    <br>
    <br>
    <br>

    <form action="./doRegister.php" method="POST">

        <label for="fname">First Name: </label>
        <input type="fname" name="fname" id="fname" required> <br><br>

        <label for="lname">Last Name: </label>
        <input type="lname" name="lname" id="lname" required><br><br>

        <label for="address">Address: </label>
        <input type="address" name="address" id="address" required><br><br>

        <label for="phone#">Phone Number: </label>
        <input type="tel" minlength="10" maxlength="10" pattern="[0-9]{10}" name="phone#" id="phone#" required><br><br>

        <label for="email">Email Address: </label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="username">Username: </label>
        <input type="username" name="username" id="username" minlength="4" required><br><br>

        <label for="password">Password: (8 characters min) </label>
        <input type="password" name="password" id="password" minlength="8" required><br><br>

        <label for="secQ">Security Question: </label>
        <input type="secQ" name="secQ" id="secQ" required><br><br>

        <label for="ans">Answer: </label>
        <input type="ans" name="ans" id="ans" required><br><br>

        <label for="role">Role: </label>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="official">Official</option>
        </select>
        <br>

        <button class="btn btn-primary button1">Submit</button>
    </form>

</body>

</html>