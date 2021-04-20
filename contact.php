<?php

session_start();
ob_start();


$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}

$commandText = "SELECT fname, lname, phone, email FROM `userinfo` where role= 'official'";
$result = $mysqli->query($commandText);


?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Page</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
    <style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 250px;
    }

    .home {
        float: left;
    }
    </style>
</head>

<body style="background-color: antiquewhite">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Contact Us</b></h1>
    <hr>

    <div class="container">
        <p class="center">
            <a href="mailto: support@fakecypress.com">Email us</a>
            at <u>support@fakecypress.com</u>
        </p>

        <p class="center">
            Call Us at <u>159-951-1478</u>
        </p>

        <h3>List of City Official's Contact Information</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['fname']." ".$row['lname'];
                    echo<<<INFO
                    <tr>
                        <th scope="row">{$name}</th>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                    </tr>
                    INFO;
                }
            ?>
            </tbody>
        </table>
    </div>

</body>

</html>