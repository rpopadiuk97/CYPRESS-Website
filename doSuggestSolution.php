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
    header("Location: ./suggest.php");
    exit();
}

if (!isset($_POST['suggestion'],$_GET['reportid'])){
    invalidErr();
}


$commandText= "SELECT * FROM `suggestions` WHERE `reportid` = ".$_GET['reportid']." AND `userid` = ".$_SESSION['user_id'];
$result = $mysqli->query($commandText);

if($result && mysqli_num_rows($result)>0){
    echo<<<ERROR
    <script>
    alert('You Already Suggested a Solution');
    window.location.href="./portalScreen.php";
    </script>
    ERROR;
}
elseif ($result && mysqli_num_rows($result)==0){

    $commandText2 = "INSERT INTO `suggestions`(`suggestion`, `reportid`, `userid`) VALUES ('".$_POST['suggestion']."',".$_GET['reportid'].",".$_SESSION['user_id'].")";
    $result2 = $mysqli->query($commandText2);

    if($result2){
        echo<<<SUCCESS
        <script>
        alert('Added Suggestion Successfully!');
        window.location.href="./portalScreen.php";
        </script>
        SUCCESS;
    }else{
        echo<<<ERROR
        <script>
        alert('Internal Error');
        window.location.href="./portalScreen.php";
        </script>
        ERROR;
    }

}
else{
    echo<<<ERROR
    <script>
    alert('Internal Error');
    window.location.href="./portalScreen.php";
    </script>
    ERROR;
}


echo $result;



?>