<?php

session_start();
ob_start();
if ( !isset( $_SESSION['user_id'] ) && $_SESSION['role']!= "official" ) {
    header("Location: ./portalScreen.php");
}

$mysqli = new mysqli("fdb29.awardspace.net","3800874_main","nB8JTF2a2T*u4Y+,","3800874_main");

if ($mysqli -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_errno;
    exit();
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Report Page</title>
    <?php include './bootstrap.php';?>
    <style>
    h1 {
        font-weight: 500 !important;
    }

    h2 {
        text-align: center;
        font-size: xx-large;
        font-weight: 700;
    }

    h3 {
        text-align: center;
        font-size: xx-large;
        font-weight: 500;
    }

    .alignleft {
        float: left !important;
    }

    .alignright {
        float: right !important;
    }
    </style>
</head>

<body style="background-color: antiquewhite">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Reports</b></h1>
    <div class="container">
        <?php

        $commandText = "SELECT reports.id, reports.zipcode, reports.message, reports.problems, reports.date, reports.open, reports.userid, userinfo.fname, userinfo.lname, userinfo.username FROM `reports` INNER JOIN `userinfo` ON reports.userid = userinfo.id ORDER BY `open` DESC, `date` DESC";
        $result = $mysqli->query($commandText);
        if($result){
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username']. " (".$row['fname']." ".$row['lname'].")";
                if ($_SESSION['user_id'] == $row['userid']){
                    $username = "ME";
                }

                $open = $row['open']==1? "OPEN": "CLOSED";
                $invisible = $row['open']==1? "": "invisible";
                $problemEdit = addslashes($row['problems']);
                $problems = unserialize($row['problems']);
                if (!empty($problems)){
                    $problems = implode(", ", $problems); 
                }
                else{
                    $problems ="";
                }
                $resolveReport = "./doResolveReport.php?reportid=".$row['id'];
                
                $commandText2= "SELECT * FROM `suggestions` INNER JOIN `userinfo` ON suggestions.userid = userinfo.id WHERE `reportid` = ".$row['id'];
                $result2 = $mysqli->query($commandText2);
                $suggestions="";
                if($result2){
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        $suggestions = $suggestions. "<li class=\"list-group-item bg-transparent\">".$row2['suggestion']." -".$row2['fname']." ". $row2['lname']."</li>";
                    }
                }
                echo<<<REPORT
                <div class="card" style="background-color: #e6caca;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Problem At {$row['zipcode']}</h5>
                        <p class="card-text">{$problems}</p>
                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" placeholder="No Comment"
                                readonly>{$row['message']}</textarea>
                        </div>
                        <br>
                        <h6 "text-center"><b>Suggestions:</b> </h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            {$suggestions}
                        </ul>
                        <hr>
                        <div class="row row-cols-3">
                            <div class="col invisible"><a href="" class="btn btn-danger"></a></div>
                            <div class="col text-center">Status: {$open}</div>
                            <div class="col {$invisible}"><a href="{$resolveReport}" class="btn btn-primary float-right">Resolve Report</a></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row row-cols-2">
                            <div class="col">Report by {$username}</div>
                            <div class="col text-right">Posted At {$row['date']}</div>
                        </div>
                    </div>
                </div>
                <hr>
                REPORT;
            
            }
        }
        
        ?>

    </div>

</body>

</html>