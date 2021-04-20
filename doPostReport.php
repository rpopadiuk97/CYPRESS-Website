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
    header("Location: ./userReport.php");
    exit();
}

if (!isset($_POST['zipcode'],$_POST['report'])){
    invalidErr();
}

$arr = serialize($_POST['problems']);
if (empty($_POST['problems'])){
    $arr=serialize(array());
}
$arr = $mysqli->real_escape_string($arr);
$message = $mysqli->real_escape_string($_POST['report']);

if(isset($_POST['reportid']) && !empty($_POST['reportid']) && $_POST['reportid']!=""){
    $commandText="UPDATE `reports` SET `zipcode`='".$_POST['zipcode']."',`message`='".$message."',`date`=CURDATE(),`problems`='".$arr."', `userid`=".$_SESSION['user_id']." WHERE `id` = ".$_POST['reportid'];
}
else{
    $commandText="INSERT INTO `reports` (`zipcode`, `message`, `date`, `problems`, `open`, `userid`) VALUES ('".$_POST['zipcode']."', '".$message."', CURDATE(), '".$arr."', '1', '".$_SESSION['user_id']."')";
}


$result = $mysqli->query($commandText);


header("Location: ./reports.php");
?>