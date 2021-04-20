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
    setcookie("message", "Invalid Info", time() + (30), "/");
    header("Location: ./userProfile.php");
    exit();
}

if (!isset($_POST['secQ'],$_POST['ans'])){
    invalidErr();
}


$commandText = "SELECT * FROM `userinfo` WHERE `id` = ".$_SESSION['user_id']." AND (`secQ` = '".$_POST['secQ']."' AND `ans` = '".$_POST['ans']."')";

$_POST = array();

$result = $mysqli->query($commandText);

if($result && mysqli_num_rows($result)>0){
    $commandText="DELETE FROM `reports` WHERE `userid` = ".$_SESSION['user_id'];
    $result = $mysqli->query($commandText);
    $commandText="DELETE FROM `userinfo` WHERE `id` = ".$_SESSION['user_id'];
    $result = $mysqli->query($commandText);
    echo<<<SUCCESS
    <script>
    alert('Deleted Account Successfully');
    window.location.href="./doLogout.php";
    </script>
    SUCCESS;
}else{
    echo<<<ERROR
    <script>
    alert('Error Deleting Account');
    window.location.href="./userProfile.php";
    </script>
    ERROR;
}


?>