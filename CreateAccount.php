

<?php
    require_once 'Account.php';
    session_start();
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
    if($_SESSION['userloggedin'] && $_SESSION['account_type'] === 'Coordinator') {
    ?>
    <body style="background-color: #d9e5ec;">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite">
        <a class="navbar-brand" href="AdminMenu.php">Admin Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Reports</a>
                <a class="nav-item nav-link" href="CreateAccount.php">Add User</a>
                <a class="nav-item nav-link" href="DeleteAccount.php">Delete User</a>
                <a  class="nav-item nav-link" href="Logout.php">Logout</a>
            </div>
        </div>
    </nav>

        <?php

        //Once the user has entered the required values, an account will be created into the database
            if(isset($_GET['email']) && isset($_GET['password'])
                && isset($_GET['fullName']) && isset($_GET['accountType'])) {
                $account = new Account($_GET['fullName'], $_GET['email'], $_GET['password'], $_GET['accountType']);
                $account->createAccountInDatabase();
            }
        ?>

        <div class="container">
            <h1>Create Account</h1>
            <form action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" name="email" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
                        <input type="text" name="fullName" class="form-control" placeholder="Full Name">
                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="accountType" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <option value="1">Teacher</option>
                            <option value="2">Coordinator</option>
                            <option value="3">Judge</option>
                        </select>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                    </div>
                </div>

            </form>
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


