
<?php
/**
 * LoginManager.php
 */

require_once 'config.php';

function login() {
    $db = mysqli_connect(Config::HOST, Config::UNAME,
        Config::PASSWORD, Config::DB_NAME) or die("Unable to connect to DB!");
    $admin_login_query = "SELECT * FROM login WHERE Account_Type = 'admin'";
    //checks to see if the uname and pword have been typed from the HTML code
    if (isset($_POST['uname']) && isset($_POST['pword'])) {
        $email = $_POST['uname'];
        $password = $_POST['pword'];
        // query login table for admin credentials
        $res = $db->query($admin_login_query);
        if (mysqli_num_rows($res) > 0) {
            // fetch row from sql result
            $row = mysqli_fetch_row($res);

            // check if email is equal to admin email and the same with password
            if ($email === $row[1]) {
                if ($password === $row[2]) {
                    $_SESSION['userloggedin'] = true;
                    $_SESSION['name'] = $row[0];
                    $_SESSION['email'] = $row[1];
                    $_SESSION['account_type'] = $row[3];
                    header("Location: AdminMenu.php");
                }
                else {
                    echo '<p style="color: red">Wrong password entered!</p>';
                }

                mysqli_free_result($res);
            }
            else {

                $user_login_query = "SELECT * FROM login WHERE Email = '$email'";
                $res = $db->query($user_login_query);

                // Check if result is empty if not go to password check
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_row($res);
                    if ($password === $row[2]) {
                        //The person logged in is a regular user, so take them to the menu page
                        $_SESSION['userloggedin'] = true;
                        $_SESSION['name'] = $row[0];
                        $_SESSION['email'] = $row[1];
                        $_SESSION['account_type'] = $row[3];
                        header("Location: MenuPage.php");
                    }
                    else {
                        echo '<p style="color: red">Wrong password entered!</p>';
                    }
                }
                else {
                    echo '<p style="color: red">User not found!</p>';
                }
                mysqli_free_result($res);
            }
        }

    }

    mysqli_close($db);
}

