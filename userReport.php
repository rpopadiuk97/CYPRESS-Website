<?php

session_start();
ob_start();
if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: ./portalScreen.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Report Page</title>
    <?php include './bootstrap.php';?>
    <style>
    h1 {
        font-weight: 500;
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
        float: left;
    }

    .alignright {
        float: right;
    }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style>
    /* Set additional styling options for the columns*/
    .column1 {
        float: left;
        width: 50%;
    }

    .row1:after {
        content: "";
        display: table;
        clear: both;
    }
    </style>
    <script>
    function searchAddress() {
        var add = document.getElementById('addressSearch').value;
        var potentialZip = "";
        if (add.length > 3) {
            var zipDoc = document.getElementById('zipcode');
            fetch("https://geocoder.ca/?locate=" + add + "&json=1")
                .then(res => (res.json()))
                .then(data => {
                    if (data.postal != undefined) {
                        zipDoc.value = data.postal;
                        document.getElementById('statusText').innerHTML = "Zipcode Found";
                        document.getElementById('statusText').style.color = "green";
                    } else {
                        document.getElementById('statusText').innerHTML = "Zipcode Not Found";
                        document.getElementById('statusText').style.color = "red";
                    }
                })
                .catch((error) => {
                    document.getElementById('statusText').innerHTML = "Zipcode Not Found";
                    document.getElementById('statusText').style.color = "red";
                });
        }
    }

    function searchlatlng(latlng) {
        var zipDoc = document.getElementById('zipcode');
        fetch("https://geocoder.ca/?locate=" + latlng.lat + "," + latlng.lng + "&json=1")
            .then(res => (res.json()))
            .then(data => {
                if (data.postal != undefined) {
                    zipDoc.value = data.postal;
                    document.getElementById('statusText').innerHTML = "Zipcode Found";
                    document.getElementById('statusText').style.color = "green";
                } else {
                    document.getElementById('statusText').innerHTML = "Zipcode Not Found";
                    document.getElementById('statusText').style.color = "red";
                }
            })
            .catch((error) => {
                document.getElementById('statusText').innerHTML = "Zipcode Not Found";
                document.getElementById('statusText').style.color = "red";
            });
    }

    function validate() {
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        var checked = false;
        for (var c = 0; c < checkboxes.length; c++) {
            if (checkboxes[c].checked) {
                return true;
            }
        }
        if (!checked) {
            alert("Check At least one Box");
        }
        return false;
    }
    </script>
</head>

<body style="background-color: antiquewhite">
    <?php include './navbar.php';?>
    <h1 class="text-center"><b>Report a Problem at a Postal Code</b></h1>
    <hr>
    <form action="./doPostReport.php" method="POST">
        <div class="row1">
            <div class="column1">
                <label for="addressSearch">Get Postal Code from Address</label>
                <input type="text" name="addressSearch" id="addressSearch">

                <input type="button" name="search" id="search" onclick="searchAddress()" value="Search">
                <p id="statusText"></p>

                <div id="mapid" style="width: 600px; height: 400px;"></div>

                <script>
                var mymap = L.map('mapid').setView([43.655081, -79.38755], 13);

                L.tileLayer(
                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                        maxZoom: 18,
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1
                    }).addTo(mymap);

                var popup = L.popup();

                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("Here")
                        .openOn(mymap);
                    searchlatlng(e.latlng);
                }

                mymap.on('click', onMapClick);
                </script>

                <br>

                <label for="zipcode">Or Click on the Map <br><br> ZipCode(no space or dashes)</label>
                <input type="text" name="zipcode" id="zipcode" minlength="6" maxlength="6"
                    value="<?php if(isset($_POST['zipcode'])){echo $_POST['zipcode'];}?>" required>
            </div>
            <div class="column1">
                <h4>Problem at the site:</h4>

                <input type="checkbox" id="utility" name="problems[]" value="Utility Failures">
                <label for="utility">Utility Failures</label><br>

                <input type="checkbox" id="potholes" name="problems[]" value="Potholes">
                <label for="potholes">Potholes</label><br>

                <input type="checkbox" id="city" name="problems[]" value="City Property of Vandalism">
                <label for="city">City Property of Vandalism</label><br>

                <input type="checkbox" id="eroded" name="problems[]" value="Eroded Streets">
                <label for="eroded">Eroded Streets</label><br>

                <input type="checkbox" id="tree" name="problems[]" value="Tree Collapse">
                <label for="tree">Tree Collapse</label><br>

                <input type="checkbox" id="flooded" name="problems[]" value="Flooded Streets">
                <label for="flooded">Flooded Streets</label><br>

                <input type="checkbox" id="mould" name="problems[]" value="Mould and Spore Growth">
                <label for="mould">Mould and Spore Growth</label><br>

                <input type="checkbox" id="garbage" name="problems[]"
                    value="Garbage or any Other Road Blocking Objects">
                <label for="garbage">Garbage or any Other Road Blocking Objects</label>

                <input type="hidden" id="reportid" name="reportid" value="<?php echo $_POST['reportid'] ?>">
                <br><br>
                <label for="report">Report Details or Other</label><br>
                <textarea id="report" name="report" rows="10" cols="50"
                    required><?php if(isset($_POST['report'])){echo $_POST['report'];}?></textarea>
                <br><br>
                <input type="submit" onclick="return validate();" value="Submit"></input>
                <script>
                var postChecked = document.querySelectorAll('input[type=checkbox]');
                var arr = [<?php
                        $temp = explode(",",$_POST['problemsUpdate']);
                        $values="";
                        foreach ($temp as $var){
                            $values = $values."\"".$var."\",";
                        }
                        echo($values);
                    ?>];
                for (var i = 0; i < postChecked.length; i++) {
                    if (arr.findIndex(element => element.includes(postChecked[i].value)) >= 0) {
                        postChecked[i].checked = true;
                    }
                }
                </script>

            </div>
        </div>
    </form>
</body>

</html>
<?php $_POST=array(); ?>