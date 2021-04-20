<?php

session_start();
ob_start();
if ( !isset( $_SESSION['user_id'] ) ) {
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
    <h1 class="text-center"><b>Delete Account</b></h1>
    <hr>
    <br>

    <div class="container">

    <h6>Please Enter your Secret Question and Answer to delete your Account</h6>
    <br>

    <form action="./doDelAccount.php" method="POST">
        <label for="secQ">Security Question: </label>
        <input type="secQ" name="secQ" id="secQ" placeholder="Security Question" required><br><br>

        <label for="ans">Security Answer: </label>
        <input type="ans" name="ans" id="ans" placeholder="Security Answer" required><br><br>
        <br>
        <button type="submit" class="btn btn-success button1">Submit</button>
    </form>
    
    

    </div>
    



</body>

</html>