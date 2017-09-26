
<?php
/**
 * LoginManager.php
 */

require_once 'config.php';

function show_error_alert($msg) {
    echo <<<ALERT_WRONG_PASS
                    <div id="wrong-pass-alert"  style="max-width: 20em; margin: 0 auto;"
                    class="alert alert-danger alert-dismissible fade show" role="alert">$msg
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
ALERT_WRONG_PASS;
}

function login() {

    
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
    
    /* $db = mysqli_connect(Config::HOST, Config::UNAME,
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
                    show_error_alert(Config::WRONG_PASS_MSG);
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
                        show_error_alert(Config::WRONG_PASS_MSG);
                    }
                }
                else {
                    show_error_alert(Config::USER_NOT_FOUND_MSG);
                }
                mysqli_free_result($res);
            }
        }

    }
    mysqli_close($db); */
}