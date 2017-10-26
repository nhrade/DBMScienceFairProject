<?php
/**
 * Account.php
 */

class Account
{
    public $name, $email, $accountType;


    function  __construct($name, $email, $password, $accountType) {
        $this->name = $name;
        $this->email = $email;
        $this->accountType = $accountType;
    }

    function createAccountInDatabase() {
        $pass = password_hash($this->password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO login VALUES ($this->name, $this->email, $pass, $this->accountType)";
        $db = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
        if($db->query($sql) === false) {
            echo "Account could not be created.";
        }
        mysqli_close($db);
    }
}