<?php

session_start();
require_once "config.php";
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

<?php

echo '<form method="post" action="SelectReport.php">';
echo '<select name="reportInformation">';


echo '<option value="student">Student Information</option>';
echo '<option value="project">Project Information</option>';
echo '<option value="kGrade">Kindergarten Information</option>';
echo '<option value="1stGrade">1st Grade Information</option>';
echo '<option value="2ndGrade">2nd Grade Information</option>';
echo '<option value="3rdGrade">3rd Grade Information</option>';
echo '<option value="4thGrade">4th Grade Information</option>';
echo '<option value="5thGrade">5th Grade Information</option>';

echo '</select>';
echo '<input type="submit" value="Select report to view"/>';
echo '</form>';

$selectedInformation = $_POST['reportInformation'];

//Establishing connection to DB so that students names can be retrieved to populate drop down  menu
$dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
    Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

if($selectedInformation == 'student'){

    $selectStudentView = "SELECT * FROM STUDENT_VIEW"; //Selecting the students name and teacher's email using the id selected from drop down menu
    $results = $dbConnection->query($selectStudentView);

    echo '<h4 class="project2">Student Information:</h4>';
    echo '<table class="table">';
    echo '<tr><td><strong>Student Name</strong></td></td><td><strong>ID</strong></td><td><strong>School</strong></td><td><strong>Grade Level</strong></td><td><strong>Teacher Name</strong></td></tr>';


    while ($row = mysqli_fetch_array($results)){
        echo '
        <tr>
                    <td>'.$row["Sfull_name"].'</td>
                    <td>' . $row["Sid"] . '</td>
                    <td>'. $row["Sschool"] .'</td>
                    <td>'. $row["Sgrade_level"] .'</td>
                    <td>'. $row["Tname"] .'</td>
                </tr>
        ';
    }
    echo "</table>";
}

else if($selectedInformation == 'project'){

    $selectProjectView = "SELECT * FROM PROJECT_VIEW"; //Selecting the students name and teacher's email using the id selected from drop down menu
    $results = $dbConnection->query($selectProjectView);

    echo '<h4 class="project2">Project Information:</h4>';
    echo '<table class="table">';
    echo '<tr><td><strong>Project Title</strong></td></td><td><strong>Description</strong></td><td><strong>Year</strong></td><td><strong>Category</strong></td><td><strong>Student Name</strong></td><td><strong>Average Score</strong></td></tr>';


    while ($row = mysqli_fetch_array($results)){
        echo '
        <tr>
                    <td>'.$row["Ptitle"].'</td>
                    <td>' . $row["Pdescription"] . '</td>
                    <td>'. $row["Pyear"] .'</td>
                    <td>'. $row["Pcategory"] .'</td>
                    <td>'. $row["student_name"] .'</td>
                    <td>'. $row["average_score"] .'</td>
                </tr>
        ';
    }
    echo "</table>";
}

else{
    $gradeLevel;
    $gradeString;
    if($selectedInformation == 'kGrade'){
        $gradeLevel = 0;
        $gradeString = "Kindergarten Information";
    }

    else if($selectedInformation == '1stGrade'){
        $gradeLevel = 1;
        $gradeString = "1st Grade Information";
    }

    else if($selectedInformation == '2ndGrade'){
        $gradeLevel = 2;
        $gradeString = "2nd Grade Information";
    }
    else if($selectedInformation == '3rdGrade'){
        $gradeLevel = 3;
        $gradeString = "3rd Grade Information";
    }
    else if($selectedInformation == '4thGrade'){
        $gradeLevel = 4;
        $gradeString = "4th Grade Information";
    }
    else if($selectedInformation == '5thGrade'){
        $gradeLevel = 5;
        $gradeString = "5th Grade Information";
    }

    //Creating the select for the grade level the user has chosen
    $gradeLevelQuery = "SELECT Sfull_name,Sgrade_level,Ptitle,Rtotal_score FROM RUBRIC NATURAL JOIN PROJECT NATURAL JOIN
                        STUDENT WHERE Sgrade_level = '$gradeLevel' GROUP BY Pid";
    $results = $dbConnection->query($gradeLevelQuery);
    echo '<h4 class="project2">'.$gradeString.':</h4>';
    echo '<table class="table">';
    echo '<tr><td><strong>Student Name</strong></td></td><td><strong>Grade Level</strong></td><td><strong>Project Title</strong></td><td><strong>Total Score</strong></td></tr>';

    while ($row = mysqli_fetch_array($results)){
        echo '
        <tr>
                    <td>'.$row["Sfull_name"].'</td>
                    <td>' . $row["Sgrade_level"] . '</td>
                    <td>'. $row["Ptitle"] .'</td>
                    <td>'. $row["Rtotal_score"] .'</td>
                </tr>
        ';
    }
    echo "</table>";

}


}
else {
    echo <<< ACCESS_STRING
            <h2 style="color: red">Access Denied: You don't have permission to access this page!</h2>
ACCESS_STRING;

}
?>
</body>
</html>