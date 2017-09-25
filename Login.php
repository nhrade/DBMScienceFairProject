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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css"
              integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    </head>

	<body style="background-color: #e6eff9">
    <div class="container">

        <!--Creating a form that will send the data to the php code above
      using the post method. uname and pword will be sent once the user has typed
      them in and clicked the login button  -->

        <form method="post" action="" class="form-signin">
            <h3 class="form-signin-heading">Login</h3>

            <input class="form-control" type="text" placeholder="Email" name="uname" required>

            <input class="form-control" type="password" placeholder="Password" name="pword" required>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <a href="">Create Account</a>
        </form>
    </div>
        <?php
            require_once 'LoginManager.php';
            login();
        ?>
    <script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js" integrity="sha384-KlVcf2tswD0JOTQnzU4uwqXcbAy57PvV48YUiLjqpk/MJ2wExQhg9tuozn5A1iVw" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/js/bootstrap-material-design.js" integrity="sha384-hC7RwS0Uz+TOt6rNG8GX0xYCJ2EydZt1HeElNwQqW+3udRol4XwyBfISrNDgQcGA" crossorigin="anonymous"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
	</body>
</html>
