<?php
/**
 * Account.php
 */

require_once 'config.php';

/**The account class is going to be used to create a new account for the user whenever
 the appropriate account selects create account. Only Teachers and Coordinators will be
 able to create accounts.*/
class Account
{
    //Used to create a new entry in the users table
    public $name, $password, $email, $accountType, $gradeLevel;

    function  __construct($name, $email, $password, $accountType) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        //The user can create 3 account types only, Judge, Teacher or Coordinator accounts
        switch ($accountType){
            case 1:
                $this->accountType = 'Teacher';
                break;
            case 2:
                $this->accountType = 'Coordinator';
                break;
            case 3:
                $this->accountType = 'Judge';
                break;
        }
    }

    /**Takes the initialized variables to create a new account into the users tables
     in the database.*/
    function createAccountInDatabase() {

        //Creating a secure password using hashes
        $pass = password_hash($this->password, PASSWORD_BCRYPT);
        $login_table_name =  Config::LOGIN_TABLE_NAME;

        //Connecting to the database to add the new user
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //Taking the values and inserting it into the user table
        $sqlQuery = "INSERT INTO users VALUES ('$this->name','$pass','$this->email',NULL,'$this->accountType')";

        if(mysqli_query($dbConnection,$sqlQuery)){
            echo "Account created successfully";
        }

        else {
            echo "Account not created! " . mysqli_error($dbConnection);
        }
        mysqli_close($dbConnection);
    }

}