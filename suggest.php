<?php

session_start();
ob_start();
if (!isset( $_SESSION['user_id'])) {
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
    <title>Suggestion Page</title>
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
    <h1 class="text-center"><b>Suggest Solutions</b></h1>
    <div class="container">
        <?php
        if(isset($_GET['reportid'])){

          $commandText= "SELECT reports.id, reports.zipcode, reports.message, reports.problems, reports.date, reports.open, reports.userid, userinfo.fname, userinfo.lname, userinfo.username FROM `reports` INNER JOIN `userinfo` ON reports.userid = userinfo.id WHERE reports.id = ".$_GET['reportid'];
          $result = $mysqli->query($commandText);
          if($result){
              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['open']==1){
                  $username = $row['username'];
                  if ($_SESSION['user_id'] == $row['userid']){
                      $username = "ME";
                  }
                  $problemEdit = addslashes($row['problems']);
                  $problems = unserialize($row['problems']);
                  if (!empty($problems)){
                      $problems = implode(", ", $problems); 
                  }
                  else{
                      $problems ="";
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
                          <hr>
                          <div class="row row-cols-3">
                              <div class="col invisible"><a href="" class="btn btn-danger"></a></div>
                              <div class="col text-center">Status: OPEN</div>
                              <div class="col invisible"><a href="" class="btn btn-primary float-right"></a></div>
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
                  

                  $doSuggestSolution = "./doSuggestSolution.php?reportid=".$row['id'];

                  echo<<<INPUT
                  <div class="card" style="background-color: #e6caca;">
                      <form action="{$doSuggestSolution}" method="POST">
                      <div class="card-body">
                          <h5 class="card-title text-center">Solution</h5>
                          <div class="input-group">
                              <textarea class="form-control" name="suggestion" aria-label="With textarea" placeholder="Suggestion" required></textarea>
                          </div>
                          <hr>
                          <div class="row row-cols-3">
                              <div class="col invisible"><a href="" class="btn btn-danger"></a></div>
                              <div class="col text-center invisible"></div>
                              <div class="col "><button onlick="location.href='{$doSuggestSolution}'" class="btn btn-success float-right">Submit</button></div>
                          </div>
                      </div>
                      </form>
                  </div>
                  <hr>
                  INPUT;





                }
              }
            } 


        }
        else{
        $commandText = "SELECT reports.id, reports.zipcode, reports.message, reports.problems, reports.date, reports.open, reports.userid, userinfo.fname, userinfo.lname, userinfo.username FROM `reports` INNER JOIN `userinfo` ON reports.userid = userinfo.id ORDER BY `open` DESC, `date` DESC";
        $result = $mysqli->query($commandText);
        if($result){
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['open']==1){
                $username = $row['username'];
                if ($_SESSION['user_id'] == $row['userid']){
                    $username = "ME";
                }
                $problemEdit = addslashes($row['problems']);
                $problems = unserialize($row['problems']);
                if (!empty($problems)){
                    $problems = implode(", ", $problems); 
                }
                else{
                    $problems ="";
                }
                $suggestSolution = "./suggest.php?reportid=".$row['id'];
                

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
                            <div class="col invisible"><a href="" class="btn btn-danger"></a></div>
                            <div class="col text-center">Status: OPEN</div>
                            <div class="col"><a href="{$suggestSolution}" class="btn btn-primary float-right">Suggest Solution</a></div>
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
          } 
        }
        ?>

    </div>

</body>

</html>