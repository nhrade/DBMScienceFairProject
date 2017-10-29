
<?php
/**
 * LoginManager.php
 */

require_once 'config.php';


class LoginManager {

    public static function show_error_alert($msg) {
        echo  <<<ALERT_WRONG_PASS
                        <div id="wrong-pass-alert"  style="max-width: 20em; margin: 0 auto;"
                        class="alert alert-danger alert-dismissible fade show" role="alert">$msg
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
ALERT_WRONG_PASS;
    }

    public function login() {

        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die("Unable to connect to DB!");

        //checks to see if the uname and pword have been typed from the HTML code
        if (isset($_POST['uname']) && isset($_POST['pword'])) {

            $email = $_POST['uname'];
            $password = $_POST['pword'];

            //Selects the information from the table corresponding to the email given
            $loginQuery = "SELECT * FROM users WHERE email = '$email'";

            // Attempts the query to find the info of the user with the given email
            if (!($queryResults = $dbConnection->query($loginQuery))) {
                echo "Query failed";
            }

            //A table that has 0 rows means that there are no entries
            if (mysqli_num_rows($queryResults) > 0) {

                // fetch row from sql result
                $row = mysqli_fetch_row($queryResults);

                // check if email is equal to admin email and the same with password
                if ($email === $row[2]) {
                    if (password_verify(password, $row[1])) {

                        $_SESSION['userloggedin'] = true;
                        $_SESSION['name'] = $row[0];
                        $_SESSION['email'] = $row[2];
                        $_SESSION['account_type'] = $row[4];

                        switch($_SESSION['account_type']){

                            case 'Judge':
                                header("Location: MenuPage.php");
                                break;
                            case 'Coordinator':
                                header("Location: AdminMenu.php");
                                break;
                            case 'Teacher':
                                header("Location: AdminMenu.php");
                                break;
                        }
                    }
                    else {
                        LoginManager::show_error_alert(Config::WRONG_PASS_MSG);
                    }
                    mysqli_free_result($queryResults);
                }
                mysqli_close($dbConnection);
            }
            else {

                LoginManager::show_error_alert(Config::USER_NOT_FOUND_MSG);

            }
        }
    }
}

