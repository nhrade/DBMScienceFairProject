<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Menu</title>
	</head>

    <?php
        if($_SESSION['userloggedin'] && $_SESSION['account_type'] === 'admin') {
    ?>
    <body>
    <h1>Admin page</h1>
    <?php
    if ($_SESSION['userloggedin']) {
        echo '<a href="Logout.php">Logout</a>';
    }
    ?>
    <h2>Menus</h2>
    <h2>Reports:</h2>
    <h2>Add Users:</h2>
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