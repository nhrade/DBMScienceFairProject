<?php
session_start();
require_once  'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports Menu</title>
    <link rel="stylesheet" href="css/navbar.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</head>

<?php
if($_SESSION['userloggedin']) {
    ?>
    <body style="background-color: ghostwhite">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite">
        <a class="navbar-brand" href="AdminMenu.php">Admin Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="Reports.php">Reports</a>
                <a class="nav-item nav-link" href="Users.php">Users</a>
                <a class="nav-item nav-link" href="StudentMenu.php">Students</a>
                <a class="nav-item nav-link" href="ViewProjects.php">Projects</a>
                <a class="nav-item nav-link" href="Logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <style>
        .project2 {
            background-color: #d9e5ec;
            color: black;
            padding: 8px;
        }

    </style>
    <?php


    $questionNumber[0] = $_POST["question1"];
    $questionNumber[1] = $_POST["question2"];
    $questionNumber[2] = $_POST["question3"];
    $questionNumber[3] = $_POST["question4"];
    $questionNumber[4] = $_POST["question5"];
    $questionNumber[5] = $_POST["question6"];
    $questionNumber[6] = $_POST["question7"];
    $questionNumber[7] = $_POST["question8"];
    $questionNumber[8] = $_POST["question9"];
    $questionNumber[9] = $_POST["question10"];
    $questionNumber[10] = $_POST["question11"];
    $questionNumber[11] = $_POST["question12"];
    $questionNumber[12] = $_POST["question13"];
    $questionNumber[13] = $_POST["question14"];
    $questionNumber[14] = $_POST["question15"];
    $questionNumber[15] = $_POST["question16"];
    $questionNumber[16] = $_POST["question17"];
    $questionNumber[17] = $_POST["question18"];
    $questionNumber[18] = $_POST["question19"];
    $questionNumber[19] = $_POST["question20"];
    $pid = $_SESSION['Pid'];

    $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
        Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
    $sum = 0;

//Adding the scores for each question based on the Judge's scoring
    for ($i = 0; $i < 20; $i++) {
        $sum = $sum + $questionNumber[$i];
    }

    $createRubricQuery = "INSERT INTO RUBRIC(Rtotal_score,Pid) VALUES ('$sum','$pid')";
    mysqli_query($dbConnection, $createRubricQuery);

    $getRubricId = "SELECT MAX(Rid) as max FROM RUBRIC";
    $results = mysqli_query($dbConnection, $getRubricId);
    $row = mysqli_fetch_array($results);

    $rubricId = $row['max'];

    for ($i = 0; $i < 20; $i++) {
        $sum = $sum + $questionNumber[$i];
        echo "For question " . $i . " you chose: " . $questionNumber[$i];
        $questionQuery = "INSERT INTO QUESTION VALUES('$i','$questionNumber[$i]','$rubricId')";
        mysqli_query($dbConnection, $questionQuery);
        echo "<br>";
    }
}
else {
        echo <<< ACCESS_STRING
            <h2 style="color: red">Access Denied: You don't have permission to access this page!</h2>
ACCESS_STRING;

    }
    ?>
    </body>
