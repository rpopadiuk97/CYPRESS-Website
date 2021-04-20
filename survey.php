<?php

session_start();
ob_start();
if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: ./portalScreen.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Survey</title>
    <?php include './bootstrap.php';?>
    <link rel="stylesheet" href="style.css">
    <script>
        function redirect(){
            alert('Thank you for your time!');
            location.href='./portalScreen.php';

        }
    </script>
</head>

<body>
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Survey</b></h1>
    <hr>
    <br>

    <div class="container bg-invisible">
        <form action="./portalScreen.php"> 
            <p>Do you Like Toronto?</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q11" value="Yes">
                <label class="form-check-label" for="q11">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q12" value="No">
                <label class="form-check-label" for="q12">No</label>
            </div>
            <br><br>
            <div class="form-group">
                <label for="exampleFormControlSelect1">If you answered Yes, What do you find most compelling about Toronto?</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Entertainment</option>
                    <option>Culture and Arts</option>
                    <option>Food</option>
                    <option>Environment</option>
                    <option>Safety & Security</option>
                </select>
            </div>
            <div class="form-group">
                <label for="q2">Or if you answered no, please tell us why </label>
                <textarea class="form-control" id="q2" rows="3"></textarea>
            </div>
            <p>Would you recommend Cypress to others?</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q31" value="Yes">
                <label class="form-check-label" for="q31">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q32" value="No">
                <label class="form-check-label" for="q32">No</label>
            </div>
            <br><br>
            <div class="form-group">
                <label for="q4">Do you have any additional comments or feedback for us?</label>
                <textarea class="form-control" id="q2" rows="3"></textarea>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary" onclick="redirect();">Submit</button>
        </form>
    </div>

</body>

</html>