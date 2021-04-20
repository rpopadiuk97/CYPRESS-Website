<?php
session_start();

$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}

function invalidErr(){
    setcookie("message", "Invalid User/Pass", time() + (30), "/");
    header("Location: ./login.php");
    exit();
}


if (!isset($_POST['username'],$_POST['password'])){
    invalidErr();
}

$commandText = "select * from userinfo where username='".$_POST['username']."'";

$result = $mysqli->query($commandText);
if($result){
    $row = mysqli_fetch_assoc($result);
    if (password_verify($_POST["password"], $row["password"])) {
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['role'] = $row["role"];
    }
    else{
        invalidErr();
    }
}
else{
    invalidErr();
}

header("Location: ./portalScreen.php");
exit();

?>