<?php

session_start();
require_once "config.php";
require_once "Delete.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>


<?php
if($_SESSION['userloggedin']) {
?>
<body style="background-color: #d9e5ec;">

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite">
    <a class="navbar-brand" href="AdminMenu.php">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="Reports.php">Reports</a>
            <a class="nav-item nav-link" href="Users.php">Users</a>
            <a  class="nav-item nav-link" href="StudentMenu.php">Students</a>
            <a  class="nav-item nav-link" href="ViewProjects.php">Projects</a>
            <a  class="nav-item nav-link" href="Logout.php">Logout</a>
        </div>
    </div>
</nav>

<style>
    .project{

        color: black;
        padding: 8px;
        display:inline;
    }

    .project2{
        background-color: ghostwhite;
        color: black;
        padding: 8px;
    }

    .names{

        color: darkred;
        padding: 8px;
        display:inline;
    }
</style>
<h4 class="project">Delete this Rubric? </h4>
<form action="DeleteRubric.php" method="post">
    <select name="delete">
        <option value="yes">Yes</option>
    </select>
    <input type="submit" value="Delete Rubric"/>
</form>
    <?php


    $rubricId = $_POST['rubric'];
    $_SESSION['DeleteID'] = $rubricId;

    //Establishing connection to DB so that students names can be retrieved to populate drop down  menu
    $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
        Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

    $rubricScores;

    //Will take every score from each question in the rubric so that it can be displayed
    for($i = 0; $i < 20; $i++){

        $displayRubrics = "SELECT Qscore FROM QUESTION WHERE QUESTION.Qid = $i AND QUESTION.Rid = $rubricId";
        $results = $dbConnection->query($displayRubrics);
        $row = $results->fetch_assoc();
        $rubricScores[$i] = $row['Qscore'];
        $sum = $sum + $row['Qscore'];
    }




    echo '<h2>Rubric</h2>';
    echo '<br>';

    echo '<h4 class="project2">Scientific Method 35 Points </h4>';
    echo '<h6 class="project">Presented a question that could be answered through experimentation.</h6>';
    echo $rubricScores[0];
    echo '<br>';

    echo '<h6 class="project">Variables and controls are defined, appropriate and complete</h6>';
    echo $rubricScores[1];
    echo '<br>';

    echo '<h6 class="project">Clear procedural plan for testing the hypothesis, includes use of control variables</h6>';
    echo $rubricScores[2];
    echo '<br>';

    echo '<h6 class="project">The conclusions are based on multiple trials (at least 3) and adequate subjects
were used. </h6>';
    echo $rubricScores[3];
    echo '<br>';

    echo '<h6 class="project">Clear and thorough process for data observation and collection </h6>';
    echo $rubricScores[4];
    echo '<br>';

    echo '<h6 class="project">Sufficient data was collected to support interpretation and conclusions. </h6>';
    echo $rubricScores[5];
    echo '<br>';

    echo '<h6 class="project">The finalist has an idea of what future research is warranted.</h6>';
    echo $rubricScores[6];

    echo '<h4 class="project2">Scientific Knowledge 20 Points </h4>';
    echo '<h6 class="project">A minimum of three age-appropriate sources for background research.</h6>';
    echo $rubricScores[7];
    echo '<br>';

    echo '<h6 class="project">Clearly identified and explained key scientific concepts relating to the experiment.</h6>';
    echo $rubricScores[8];
    echo '<br>';

    echo '<h6 class="project">Used scientific principles and/or mathematical formulas correctly in the experiment.</h6>';
    echo $rubricScores[9];
    echo '<br>';

    echo '<h6 class="project">Student suggests changes to the experimental procedure and/or possibilities
for further study, while evaluating the success and effectiveness of the project. </h6>';
    echo $rubricScores[10];
    echo '<br>';

    echo '<h4 class="project2">Presentation 30 Points </h4>';
    echo '<h6 class="project">Offers clarity of graphics and legends</h6>';
    echo $rubricScores[11];
    echo '<br>';

    echo '<h6 class="project">The important phases of the project are presented in an orderly manner.</h6>';
    echo $rubricScores[12];
    echo '<br>';

    echo '<h6 class="project">Pictures and diagrams effectively convey information about the science fair project.</h6>';
    echo $rubricScores[13];
    echo '<br>';

    echo '<h6 class="project">Understands the basic science relevance of the project.</h6>';
    echo $rubricScores[14];
    echo '<br>';

    echo '<h6 class="project">Offers clear, concise, and thoughtful responses to questions.</h6>';
    echo $rubricScores[15];
    echo '<br>';

    echo '<h6 class="project">Includes a lab notebook (High school requires a research paper.)</h6>';
    echo $rubricScores[16];
    echo '<br>';

    echo '<h4 class="project2">Creativity 15 Points </h4>';
    echo '<h6 class="project">Student presents the relevance of the project</h6>';
    echo $rubricScores[17];
    echo '<br>';

    echo '<h6 class="project">Investigated an original question, used an original approach, or technique. </h6>';
    echo $rubricScores[18];
    echo '<br>';

    echo '<h6 class="project">Shows enthusiasm and interest in the project. </h6>';
    echo $rubricScores[19];
    echo '<br>';

    echo '<h4 class="project2">Total Score </h4>';
    echo '<h6 class="names">'.$sum.'</h6>';
    echo '<br>';
    ?>


<?php
}

else {
    echo <<< ACCESS_STRING
            <h2 style="color: red">Access Denied: You don't have permission to access this page!</h2>
ACCESS_STRING;

}
?>
</body>
</html>