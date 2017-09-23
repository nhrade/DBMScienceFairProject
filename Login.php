<!-- Login.php -->

<?php
    //Starting a session whenever the webpage is visited
    session_start();
    if($_SESSION['userloggedin']) {
        if($_SESSION['account_type'] !== 'admin') {
            header('Location: MenuPage.php');
        }
    }
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Login</title>
	</head>

	<body>

		<h1>Log In</h1>
		<div class="loginarea" style="background-color:#f1f1f1">
	
			<!--Creating a form that will send the data to the php code above
		  using the post method. uname and pword will be sent once the user has typed
		  them in and clicked the login button  -->
		
			<form method="post" action="">
				<label><b>Email: </b></label>
			     <!-- Text area for the username to be entered called uname. Will be sent to the php code -->
				<input type="text" placeholder="Email" name="uname" required>
				<br/>
				<label><strong>Password: </strong></label>
				<input type="password" placeholder="Password" name="pword" required>
				<br/>
				<button type="submit">Login</button>
				<br/>
			</form>
		</div>
        <?php
            require_once 'LoginManager.php';
            login();
        ?>
	</body>
</html>
