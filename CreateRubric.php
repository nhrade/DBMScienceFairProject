<?php
require_once 'Student.php';
require_once 'config.php';
session_start();
$_SESSION['gradingStudent'] = true;
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
if($_SESSION['userloggedin'] && $_SESSION['gradingStudent']) {
?>
<body style="background-color: #d9e5ec;">

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite">
    <a class="navbar-brand" href="AdminMenu.php">Admin Menu</a>
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

    .options{
        background-color: ghostwhite;
        color: black;
        padding: 8px;
        display:inline;
    }

</style>

<?php
$option = isset($_POST['studentToGrade']) ? $_POST['studentToGrade'] : false;
if ($option) {

    $id = $_POST['studentToGrade'];

    $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
        Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

    $getFullNamQuery = "SELECT Sfull_name,Uemail FROM STUDENT WHERE Sid = $id"; //Selecting the students name and teacher's email using the id selected from drop down menu
    $results = $dbConnection->query($getFullNamQuery);
    $row = $results->fetch_assoc(); //Row that contains Sfull_name and Uemail
    $fullName = $row['Sfull_name'];
    $teacherEmail = $row['Uemail'];

    $getTeachersNameQuery = "SELECT Ufull_name FROM USER WHERE Uemail = '$teacherEmail'";
    $results = $dbConnection->query($getTeachersNameQuery);
    $row = $results->fetch_assoc();
    $teacherFullName = $row['Ufull_name'];

    $getProjectInfo = "SELECT * FROM PROJECT WHERE Sid =$id";
    $results = $dbConnection->query($getProjectInfo);
    $row = $results->fetch_assoc();
    $category = $row['Pcategory'];
    $title = $row['Ptitle'];
    $_SESSION['Pid'] = $row['Pid'];

   echo '<form method="POST" action="Result.php">';
    echo '<h1>Canutillo Independent School District Science Fair Judging Rubric</h1>';
    echo '<h4 class="project">Student Name:</h4>';
    echo '<h4 class="names">'.$fullName.'</h4>';
    echo '<h4 class="project">Teacher Name:</h4>';
    echo '<h4 class="names">'.$teacherFullName.'</h4>';
    echo '<h4 class="project">Category </h4>';
    echo '<h4 class="names">'.$category.'</h4>';
    echo '<h4 class="project2">Project Title</h4>';
    echo '<h4 class="names">'.$title.'</h4>';
    echo '<h4 class="project2">Rubric Number (No duplicate numbers allowed) </h4>';
    echo '<input type="text" name="rubricNumber" placeholder="Unique rubric number. No duplicates">';

    echo '<h4 class="project2">Scientific Method 35 Points </h4>';
    echo '<h6 class="project">Q1) Presented a question that could be answered through experimentation.</h6>';
    echo '<input class ="names"type="radio" name="question1" value="5">5             ';
    echo '<input class ="project"type="radio" name="question1" value="4">4             ';
    echo '<input class ="project"type="radio" name="question1" value="3">3             ';
    echo '<input class ="project"type="radio" name="question1" value="2">2             ';
    echo '<input class ="project"type="radio" name="question1" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q2) Variables and controls are defined, appropriate and complete</h6>';
    echo '<input class ="names"type="radio" name="question2" value="5">5             ';
    echo '<input class ="project"type="radio" name="question2" value="4">4             ';
    echo '<input class ="project"type="radio" name="question2" value="3">3             ';
    echo '<input class ="project"type="radio" name="question2" value="2">2             ';
    echo '<input class ="project"type="radio" name="question2" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q3) Clear procedural plan for testing the hypothesis, includes use of control variables</h6>';
    echo '<input class ="names"type="radio" name="question3" value="5">5             ';
    echo '<input class ="project"type="radio" name="question3" value="4">4             ';
    echo '<input class ="project"type="radio" name="question3" value="3">3             ';
    echo '<input class ="project"type="radio" name="question3" value="2">2             ';
    echo '<input class ="project"type="radio" name="question3" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q4) The conclusions are based on multiple trials (at least 3) and adequate subjects
were used. </h6>';
    echo '<input class ="names"type="radio" name="question4" value="5">5             ';
    echo '<input class ="project"type="radio" name="question4" value="4">4             ';
    echo '<input class ="project"type="radio" name="question4" value="3">3             ';
    echo '<input class ="project"type="radio" name="question4" value="2">2             ';
    echo '<input class ="project"type="radio" name="question4" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q5) Clear and thorough process for data observation and collection </h6>';
    echo '<input class ="names"type="radio" name="question5" value="5">5             ';
    echo '<input class ="project"type="radio" name="question5" value="4">4             ';
    echo '<input class ="project"type="radio" name="question5" value="3">3             ';
    echo '<input class ="project"type="radio" name="question5" value="2">2             ';
    echo '<input class ="project"type="radio" name="question5" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q6) Sufficient data was collected to support interpretation and conclusions. </h6>';
    echo '<input class ="names"type="radio" name="question6" value="5">5             ';
    echo '<input class ="project"type="radio" name="question6" value="4">4             ';
    echo '<input class ="project"type="radio" name="question6" value="3">3             ';
    echo '<input class ="project"type="radio" name="question6" value="2">2             ';
    echo '<input class ="project"type="radio" name="question6" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q7) The finalist has an idea of what future research is warranted.</h6>';
    echo '<input class ="names"type="radio" name="question7" value="5">5             ';
    echo '<input class ="project"type="radio" name="question7" value="4">4             ';
    echo '<input class ="project"type="radio" name="question7" value="3">3             ';
    echo '<input class ="project"type="radio" name="question7" value="2">2             ';
    echo '<input class ="project"type="radio" name="question7" value="1">1             ';

    echo '<h4 class="project2">Scientific Knowledge 20 Points </h4>';
    echo '<h6 class="project">Q8) A minimum of three age-appropriate sources for background research.</h6>';
    echo '<input class ="names"type="radio" name="question8" value="5">5             ';
    echo '<input class ="project"type="radio" name="question8" value="4">4             ';
    echo '<input class ="project"type="radio" name="question8" value="3">3             ';
    echo '<input class ="project"type="radio" name="question8" value="2">2             ';
    echo '<input class ="project"type="radio" name="question8" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q9) Clearly identified and explained key scientific concepts relating to the experiment.</h6>';
    echo '<input class ="names"type="radio" name="question9" value="5">5             ';
    echo '<input class ="project"type="radio" name="question9" value="4">4             ';
    echo '<input class ="project"type="radio" name="question9" value="3">3             ';
    echo '<input class ="project"type="radio" name="question9" value="2">2             ';
    echo '<input class ="project"type="radio" name="question9" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q10) Used scientific principles and/or mathematical formulas correctly in the experiment.</h6>';
    echo '<input class ="names"type="radio" name="question10" value="5">5             ';
    echo '<input class ="project"type="radio" name="question10" value="4">4             ';
    echo '<input class ="project"type="radio" name="question10" value="3">3             ';
    echo '<input class ="project"type="radio" name="question10" value="2">2             ';
    echo '<input class ="project"type="radio" name="question10" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q11) Student suggests changes to the experimental procedure and/or possibilities
for further study, while evaluating the success and effectiveness of the project. </h6>';
    echo '<input class ="names"type="radio" name="question11" value="5">5             ';
    echo '<input class ="project"type="radio" name="question11" value="4">4             ';
    echo '<input class ="project"type="radio" name="question11" value="3">3             ';
    echo '<input class ="project"type="radio" name="question11" value="2">2             ';
    echo '<input class ="project"type="radio" name="question11" value="1">1             ';
    echo '<br>';

    echo '<h4 class="project2">Presentation 30 Points </h4>';
    echo '<h6 class="project">Q12) Offers clarity of graphics and legends</h6>';
    echo '<input class ="names"type="radio" name="question12" value="5">5             ';
    echo '<input class ="project"type="radio" name="question12" value="4">4             ';
    echo '<input class ="project"type="radio" name="question12" value="3">3             ';
    echo '<input class ="project"type="radio" name="question12" value="2">2             ';
    echo '<input class ="project"type="radio" name="question12" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q13) The important phases of the project are presented in an orderly manner.</h6>';
    echo '<input class ="names"type="radio" name="question13" value="5">5             ';
    echo '<input class ="project"type="radio" name="question13" value="4">4             ';
    echo '<input class ="project"type="radio" name="question13" value="3">3             ';
    echo '<input class ="project"type="radio" name="question13" value="2">2             ';
    echo '<input class ="project"type="radio" name="question13" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q14) Pictures and diagrams effectively convey information about the science fair project.</h6>';
    echo '<input class ="names"type="radio" name="question14" value="5">5             ';
    echo '<input class ="project"type="radio" name="question14" value="4">4             ';
    echo '<input class ="project"type="radio" name="question14" value="3">3             ';
    echo '<input class ="project"type="radio" name="question14" value="2">2             ';
    echo '<input class ="project"type="radio" name="question14" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q15) Understands the basic science relevance of the project.</h6>';
    echo '<input class ="names"type="radio" name="question15" value="5">5             ';
    echo '<input class ="project"type="radio" name="question15" value="4">4             ';
    echo '<input class ="project"type="radio" name="question15" value="3">3             ';
    echo '<input class ="project"type="radio" name="question15" value="2">2             ';
    echo '<input class ="project"type="radio" name="question15" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q16) Offers clear, concise, and thoughtful responses to questions.</h6>';
    echo '<input class ="names"type="radio" name="question16" value="5">5             ';
    echo '<input class ="project"type="radio" name="question16" value="4">4             ';
    echo '<input class ="project"type="radio" name="question16" value="3">3             ';
    echo '<input class ="project"type="radio" name="question16" value="2">2             ';
    echo '<input class ="project"type="radio" name="question16" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q17) Includes a lab notebook (High school requires a research paper.)</h6>';
    echo '<input class ="names"type="radio" name="question17" value="5">5             ';
    echo '<input class ="project"type="radio" name="question17" value="4">4             ';
    echo '<input class ="project"type="radio" name="question17" value="3">3             ';
    echo '<input class ="project"type="radio" name="question17" value="2">2             ';
    echo '<input class ="project"type="radio" name="question17" value="1">1             ';
    echo '<br>';

    echo '<h4 class="project2">Creativity 15 Points </h4>';
    echo '<h6 class="project">Q18) Student presents the relevance of the project</h6>';
    echo '<input class ="names"type="radio" name="question18" value="5">5             ';
    echo '<input class ="project"type="radio" name="question18" value="4">4             ';
    echo '<input class ="project"type="radio" name="question18" value="3">3             ';
    echo '<input class ="project"type="radio" name="question18" value="2">2             ';
    echo '<input class ="project"type="radio" name="question18" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q19) Investigated an original question, used an original approach, or technique. </h6>';
    echo '<input class ="names"type="radio" name="question19" value="5">5             ';
    echo '<input class ="project"type="radio" name="question19" value="4">4             ';
    echo '<input class ="project"type="radio" name="question19" value="3">3             ';
    echo '<input class ="project"type="radio" name="question19" value="2">2             ';
    echo '<input class ="project"type="radio" name="question19" value="1">1             ';
    echo '<br>';

    echo '<h6 class="project">Q20) Shows enthusiasm and interest in the project. </h6>';
    echo '<input class ="names"type="radio" name="question20" value="5">5             ';
    echo '<input class ="project"type="radio" name="question20" value="4">4             ';
    echo '<input class ="project"type="radio" name="question20" value="3">3             ';
    echo '<input class ="project"type="radio" name="question20" value="2">2             ';
    echo '<input class ="project"type="radio" name="question20" value="1">1             ';
    echo '<br>';

    echo '<input type="submit" value="Result" name="Finish">';
    echo '</form>';

} else {
    echo "Please select a student";
    exit;
}
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