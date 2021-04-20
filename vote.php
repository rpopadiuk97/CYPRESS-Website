<?php

session_start();
ob_start();
?>
<html>

<head>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
    <title>Vote</title>
</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Vote</b></h1>
    <hr>
    <h3 class="text-center">Have you voted yet?</h3>
    <input type="radio" id="Yes" name="Q1" value="Yes" required>
    <label for="Yes">Yes</label><br></label>
    <input type="radio" id="No" name="Q1" value="No">
    <label for="No">No</label><br></label>

    <p>If not, will you be voting?</p>
    <input type="radio" id="Already" name="Q2" value="Already" required>
    <label for="Already">I have already voted</label><br></label>
    <input type="radio" id="Yes1" name="Q2" value="Yes">
    <label for="Yes1">Yes</label><br></label>
    <input type="radio" id="No1" name="Q2" value="No">
    <label for="No1">No</label><br></label>


    <p>If you will not be voting please explain why:</p>

    <input type="radio" id="Voting" name="Q3" value="Voting" required>
    <label for="Voting">I will be voting</label><br></label>

    <input type="radio" id="18plus" name="Q3" value="18plus">
    <label for="18plus">I am not 18+</label><br></label>

    <input type="radio" id="notCitizen" name="Q3" value="notCitizen">
    <label for="notCitizen">I am not a Canadian Citizen</label><br></label>

    <input type="radio" id="notInterested" name="Q3" value="notInterested">
    <label for="notInterested">I am not interested</label><br></label>

    <input type="radio" id="nothome" name="Q3" value="nothome">
    <label for="nothome">I am out of town/not home</label><br></label>

    <input type="radio" id="problem" name="Q3" value="problem">
    <label for="problem">Registration Problems</label><br></label>

    <input type="radio" id="far" name="Q3" value="far">
    <label for="far">Voting area/booth is too far </label><br></label>

    <input type="radio" id="Transportation" name="Q3" value="Transportation">
    <label for="Transportation">Transportation Problems </label><br></label>

    <input type="radio" id="busy" name="Q3" value="busy">
    <label for="busy">Polling hours are inconvient for me</label><br></label>

    <input type="radio" id="nothing" name="Q3" value="nothing">
    <label for="nothing">Prefer not to say</label><br></label>

    <input type="radio" id="other" name="Q3" value="other">
    <label for="other">Other, please specify: </label><br></label>

    <textarea id="otherReason" name="otherReason" rows="3" cols="50"></textarea>


    <br></br>
    <input class="btn btn-primary" onclick="alert('Thank you For Voting'); location.href='./portalScreen.php'" type="submit" value="Submit">


</body>

</html>