<!-- Login.php -->

<?php
    //Starting a session whenever the webpage is visited
    session_start();
    if($_SESSION['userloggedin']) {
        if($_SESSION['account_type'] !== 'admin') {
            header('Location: MenuPage.php');
        }
        else {
            header('Location: AdminMenu.php');
        }
    }
?>
<!DOCTYPE html>

<html lang="en">

	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Login</title>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js" type="text/javascript"></script>
    </head>

	<body style="background-color: #d9e5ec;">
    <div class="container">

        <!--Creating a form that will send the data to the php code above
      using the post method. uname and pword will be sent once the user has typed
      them in and clicked the login button  -->

        <form method="post" action="" class="form-signin">
            <h3 class="form-signin-heading">Science Fair Database</h3>

            <input class="form-control" type="text" placeholder="Email" name="uname" required>

            <input class="form-control" type="password" placeholder="Password" name="pword" required>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <a id="create-account-link">Create Account</a>
        </form>
    </div>
        <?php
            require_once 'LoginManager.php';
            $manager = new LoginManager();
            $manager->login();
        ?>

	</body>
</html>
