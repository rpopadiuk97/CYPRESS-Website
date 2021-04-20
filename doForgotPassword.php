<?php
session_start();


$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}

if (!isset($_POST['username'],$_POST['secQ'],$_POST['ans'])){
    setcookie("message", "Error", time() + (30), "/");
    header("Location: ./forgotPassword.php");
    exit();
}


$commandText = "SELECT * FROM `userinfo` WHERE (`username` = '".$_POST['username']."' OR `email` = '".$_POST['username']."') AND (`secQ` = '".$_POST['secQ']."' AND `ans` = '".$_POST['ans']."')";

$_POST = array();

$result = $mysqli->query($commandText);

if($result && mysqli_num_rows($result)>0){
    setcookie("message", "Account Found, Password Sent to your Email", time() + (30), "/");
    header("Location: ./forgotPassword.php");
    exit();
}
else{
    setcookie("message", "Error Account Not Found, Username and/or Security Answers are incorrect", time() + (30), "/");
    header("Location: ./forgotPassword.php");
    exit();
}

?>