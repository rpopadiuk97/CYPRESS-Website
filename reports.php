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


$commandText = "SELECT * FROM `userinfo` WHERE `id` = ".$_SESSION['user_id'];
$result = $mysqli->query($commandText);
$row=mysqli_fetch_assoc($result);
$username = $row['username'];



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
    <script>
    function Editform(reportid, message, problems, zipcode) {
        var form = document.createElement("form");
        var element1 = document.createElement("input");
        var element2 = document.createElement("input");
        var element3 = document.createElement("input");
        var element4 = document.createElement("input");

        form.method = "POST";
        form.action = "./userReport.php";

        element1.value = reportid;
        element1.name = "reportid";
        form.appendChild(element1);

        element2.value = message;
        element2.name = "report";
        form.appendChild(element2);

        element3.value = problems;
        element3.name = "problemsUpdate";
        form.appendChild(element3);

        element4.value = zipcode;
        element4.name = "zipcode";
        form.appendChild(element4);

        document.body.appendChild(form);
        form.submit();
    }
    </script>
</head>

<body style="background-color: antiquewhite">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Reports</b></h1>
    <div class="container">
        <?php

        $commandText = "SELECT * FROM `reports` WHERE `userid` = '".$_SESSION['user_id']."' ORDER BY `date` DESC";
        $result = $mysqli->query($commandText);
        if($result){
            while ($row = mysqli_fetch_assoc($result)) {
                $open = $row['open']==1? "OPEN": "CLOSED";
                $problemEdit = addslashes($row['problems']);
                $problems = unserialize($row['problems']);
                if (!empty($problems)){
                    $problems = implode(", ", $problems); 
                }
                else{
                    $problems ="";
                }
                $problems = addslashes($problems);
                $delLink = "./doDelReport.php?reportid=".$row['id'];
                

                echo<<<REPORT
                <div class="card" style="background-color: #e6caca;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Problem At {$row['zipcode']}</h5>
                        <p class="card-text">{$problems}</p>
                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" placeholder="No Comment"
                                readonly>{$row['message']}</textarea>
                        </div>
                        <hr>
                        <div class="row row-cols-3">
                            <div class="col"><a href="{$delLink}" onclick="return confirm('Are you sure you want to delete this report?')" class="btn btn-danger">Delete</a></div>
                            <div class="col text-center">Status: {$open}</div>
                            <div class="col "><a href="#" onclick="Editform('{$row['id']}',`{$row['message']}`,`{$problems}`,'{$row['zipcode']}')" class="btn btn-info float-right">Edit</a></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row row-cols-2">
                            <div class="col">Report by Me</div>
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