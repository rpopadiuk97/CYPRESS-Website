<?php

session_start();
ob_start();
if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: ./portalScreen.php");
}

$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}


$commandText = "SELECT * FROM `userinfo` WHERE `id` = ".$_SESSION['user_id'];
$result = $mysqli->query($commandText);
$row=mysqli_fetch_assoc($result);


$fname = ucwords($row['fname']);
$lname = ucwords($row['lname']);
$address = ucwords($row['address']);
$phone = ucwords($row['phone']);
$email = $row['email'];
$username = $row['username'];



?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <?php include './bootstrap.php';?>
    <style>
    .title1 {
        font-weight: bold;
        float: left;
    }

    .title2 {
        font-weight: bold;
        float: right;
    }

    .left {
        float: left;
    }
    </style>
</head>

<body style="background-color: beige">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>User Information</b></h1>
    <hr>
    <div class="container" id="displayInfo">
        <?php
    echo<<<INFO
    <h4>First Name: {$fname}</h4>
    <h4>Last Name: {$lname}</h4>
    <h4>Address: {$address}</h4>
    <h4>Phone Number: {$phone}</h4>
    <h4>Email Address: {$email}</h4>
    <h4>Username: {$username}</h4>
    <h4>Password: ***********</h4>
    INFO;
    ?>
    </div>
    <br><br><br>
    <form action="./doChangeDetails.php" method="POST">
        <div class="container">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">First Name</span>
                </div>
                <input type="text" class="form-control" name="fname" placeholder="First Name" aria-label="First Name" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Last Name</span>
                </div>
                <input type="text" class="form-control" name="lname" placeholder="Last Name" aria-label="Last Name" required>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <input type="text" class="form-control" name="address" placeholder="Address" aria-label="Address" required>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Phone Number</span>
                </div>
                <input type="tel" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" name="phone#" placeholder="Phone Number" aria-label="Phone Number" required>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" minlength="8" required>
            </div>


            <button class="btn btn-secondary" type="submit" name="changeInfo" value="Change Info" onclick="return confirm('Are you sure?')" id="changeInfo">Change Info</button>
            <button class="btn btn-danger float-right" type="button" name="deleteAccount" value="deleteAccount" onclick="location.href='./deleteAccount.php'" id="deleteAccount">Delete Account</button>
        </div>
    </form>

</body>

</html>