<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Menu</title>
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
        background-color: #d9e5ec;
        color: black;
        padding: 10px;
    }

</style>
<h2
<a class="project" type="button" onclick="location.href='CreateAccount.php'">Add A New User</a>
</h2>
<p>
    Add a new account for a user. Will require email, name, password, and account type
</p>

<h2
<a class="project" type="button" onclick="location.href='DeleteAccount.php'">Delete A User</a>
</h2>
<p>
    Allows for accounts to be deleted by entering the email associated with the account.
</p>
<?php
}
else {
    echo <<< ACCESS_STRING
            <h2 style="color: red">Access Denied: You don't have permission to access this page!</h2>
ACCESS_STRING;

}
?>
</body>