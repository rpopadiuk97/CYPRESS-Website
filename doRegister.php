<?php
session_start();


$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}

if (!isset($_POST['fname'],$_POST['lname'],$_POST['address'],$_POST['phone#'],$_POST['username'],$_POST['email'],$_POST['password'],$_POST['secQ'],$_POST['ans'],$_POST['role'])){
    setcookie("message", "Registration Failed", time() + (30), "/");
    header("Location: ./register.php");
    exit();
}

if($_POST['role']!= "user" && $_POST['role']!= "official"){
    setcookie("message", "Registration Failed", time() + (30), "/");
    header("Location: ./register.php");
    exit();
}

$pass = password_hash($_POST["password"],PASSWORD_DEFAULT);


$commandText = "INSERT INTO `userinfo` (`fname`, `lname`, `address`, `phone`, `email`, `username`, `password`, `secQ`, `ans`, `role`) VALUES ('".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['address']."', ".$_POST['phone#'].", '".$_POST['email']."', '".$_POST['username']."', '".$pass."', '".$_POST['secQ']."', '".$_POST['ans']."', '".$_POST['role']."')";



$result = $mysqli->query($commandText);
$_POST = array();
if($result){
    setcookie("message", "Account Created", time() + (30), "/");
    header("Location: ./login.php");
    exit();
}
else{
    setcookie("message", "Error Creating Account or Username Already taken".$commandText, time() + (30), "/");
    header("Location: ./register.php");
    exit();
}

?>