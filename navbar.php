<?php

if(!isset($_SESSION['user_id'])){
    $loggedin = <<<BUTTON
    <button class="btn btn-info my-2 mr-sm-2" onclick="location.href='./register.php'" type="button">Register</button>
    <button class="btn btn-warning my-1 my-sm-2" onclick="location.href='./login.php'" type="button">Login</button>
    BUTTON;
}
else {
    $loggedin = <<<LOGOUT
    <button class="btn btn-danger my-2 my-sm-0" onclick="location.href='./doLogout.php'" type="button">Logout</button>
    LOGOUT;
    $loggedinTabs = <<<TABS
    <li class="nav-item active">
        <a class="nav-link" href="./portalScreen.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./userProfile.php">User Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./userReport.php">Report a Problem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./reports.php">My Reports</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./suggest.php">Suggest Solutions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./vote.php">Vote</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./survey.php">Survey</a>
    </li>
    TABS;
    if($_SESSION['role']=='official'){
      $cityOfficial=<<<OFFICIAL
      <li class="nav-item">
        <a class="nav-link" href="./allReports.php">All Reports</a>
      </li>
      OFFICIAL;
    }
}
echo<<<HERE
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #c0e341a6;">
  <a class="navbar-brand" href="./index.html"><b>Cypress</b> <small><sub>City of Toronto</sub></small></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      {$loggedinTabs}
      {$cityOfficial}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="./FAQ.php">FAQ</a>
          <a class="dropdown-item" href="./contact.php">Contact Us</a>
        </div>
      </li>
    </ul>
  </div>
  {$loggedin}
</nav>
HERE;

?>