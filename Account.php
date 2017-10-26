<?php
/**
 * Account.php
 */

class Account
{
    public $name, $password, $email, $accountType;


    function  __construct($name, $email, $password, $accountType) {
        $this->name = $name;
        $this->email = $email;
        $this->password;
        $this->accountType = $accountType;
    }

    function createAccountInDatabase() {
        $pass = password_hash($this->password, PASSWORD_BCRYPT);
        $login_table_name =  Config::LOGIN_TABLE_NAME;
        $sql = "INSERT INTO  $login_table_name VALUES ($this->name, $this->email, $this->$pass, $this->accountType)";
        $db = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
        if($db->query($sql) === false) {
            echo "Account could not be created.";
        }
        mysqli_close($db);
    }
}