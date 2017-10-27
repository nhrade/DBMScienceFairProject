
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

    <body style="background-color: #d9e5ec;">

<div class="container">
    <h1>Delete Account</h1>
    <form action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email to delete">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Delete Account</button>
            </div>
        </div>

    </form>
</div>
</body>
</html>

<?php

require_once "DisplayTables.php";
require_once "Delete.php";

//Displaying the users table
$displayUsers = new DisplayTables();
$displayUsers->displayUsersTable();

//Attempts to delete the email the user has entered in the email area
if(isset($_GET["email"])){
    $email = $_GET["email"];
    $deleteAccount = new Delete($email);
    $deleteAccount ->deleteAccount();
}
?>
