<?php
session_start();

if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: ./portalScreen.php");
}

$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}

function invalidErr(){
    setcookie("message", "Invalid Review Info", time() + (30), "/");
    header("Location: ./reports.php");
    exit();
}

if (!isset($_GET['reportid'])){
    invalidErr();
}

$commandText="SELECT * FROM `reports` WHERE `id` = ".$_GET['reportid'];

$result = $mysqli->query($commandText);
$row = mysqli_fetch_assoc($result);
if ($row['userid']==$_SESSION['user_id']){
    $commandText="DELETE FROM `reports` WHERE `id` = ".$_GET['reportid'];
    $result = $mysqli->query($commandText);
}


header("Location: ./reports.php");
?>