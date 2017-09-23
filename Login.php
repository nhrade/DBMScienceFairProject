<!DOCTYPE html>

<?php 

    //Starting a session whenever the webpage is visited
    session_start();
    
    //Accepted usernames and passwords
    $uname = array("admin","user");
    $pword = array("admin1","user1");
    
    //checks to see if the uname and pword have been typed from the HTML code
    if(isset($_POST['uname']) && isset($_POST['pword'])) {
        
        //checks to see if the entered username and passwords are correct
        //POST gets the uname entered from the website and checks with the accepted usernames and passwords
        if(($_POST['uname'] == $uname[0] && $_POST['pword'] == $pword[0])){
            
            //The user is an admin so they need to be redirected to admin page
            $_SESSION['userloggedin'] = true;
            header("Location: AdminMenu.php");
        }
        
        if(($_POST['uname'] == $uname[1] && $_POST['pword'] == $pword[1])){
            
            //The person logged in is a regular user, so take them to the meunu page
            $_SESSION['userloggedin'] = true;
            header("Location: MenuPage.php");
        }
        
    }
?>


<html>

	<head>
		<title>WebSite</title>
	</head>

	<body>
	
		<h1>Log In</h1>
		<div class="loginarea" style="background-color:#f1f1f1">
	
			<!--Creating a form that will send the data to the php code above
		  using the post method. uname and pword will be sent once the user has typed
		  them in and clicked the login button  -->
		
			<form method="post" action="Login.php">
				<label><b>Username:</b></label>
			     <!-- Text area for the username to be entered called uname. Will be sent to the php code -->
				<input type="text" placeholder="Enter Username" name="uname" required>
				<br/>
				<label><strong>Password :</strong></label>
				<input type="password" placeholder="Enter Password" name="pword" required>
				<br/>
				<button type="submit">Login</button>
				<br/>
			</form>
		</div>
	</body>
</html>
