<?php

session_start();
require_once "DisplayTables.php";

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

<div class="container">
    <h1>Select A Student</h1>
    <?php

    $studentId = $_POST['studentInformation'];

    //Establishing connection to DB so that students names can be retrieved to populate drop down  menu
    $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
        Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
    $displayRubrics = "SELECT Rid FROM RUBRIC NATURAL JOIN PROJECT WHERE PROJECT.Pid = RUBRIC.Pid AND PROJECT.Sid = $studentId"; //Selecting id and student name from STUDENT table for drop down menu
    $results = $dbConnection->query($displayRubrics);

    //The user will select the student's name and will be taken to another page so that a rubric can be created for the select student
    //The student is selected and his/her unique id is stored so that data can be stored in the database using the id
    echo '<form method="post" action="ShowRubric.php">';
    echo '<select name="rubric">';

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $_SESSION['ReportId'] = $row['Rid'];
            $rubricId = $row['Rid'];
            echo '<option value="'.$rubricId.'">'.$rubricId.'</option>';
        }
    }
    echo '</select>';
    echo '<input type="submit" value="Select the Rubric to View"/>';
    echo '</form>';
    ?>


</div>

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