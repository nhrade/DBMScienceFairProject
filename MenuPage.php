<?php 

    session_start();
    //The user has not logged in or has logged out, so needs to go to the login page
    if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] == false){
        header("Location: Login.php");
    }

?>


<!DOCTYPE html>
<html>

	<head>
		<title>Menu Selection</title>
	</head>

	<body>
		<h1>Regular User Page</h1>
        <h2>Hello <?php $_SESSION['name'] ?></h2>
		<br/>
		<h2>Menus</h2>
		<h3>Reports:</h3>
	</body>

</html>