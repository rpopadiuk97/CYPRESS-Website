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

if (!isset($_POST['fname'],$_POST['lname'],$_POST['address'],$_POST['phone#'],$_POST['email'],$_POST['password'])){
    setcookie("message", "Change Failed" . print_r($_POST,true), time() + (30), "/");
    header("Location: ./userProfile.php");
    exit();
}


$pass = password_hash($_POST["password"],PASSWORD_DEFAULT);


$commandText = "UPDATE `userinfo` SET `fname`='".$_POST['fname']."',`lname`='".$_POST['lname']."',`address`='".$_POST['address']."',`phone`=".$_POST['phone#'].",`email`='".$_POST['email']."',`password`='".$pass."' WHERE `id` =".$_SESSION['user_id'];

$_POST = array();

$result = $mysqli->query($commandText);

if($result){
    header("Location: ./userProfile.php");
    exit();
}
else{
    header("Location: ./userProfile.php");
    exit();
}

?>