<?php
require_once 'config.php';
/**
 * Created by PhpStorm.
 * User: lgflores
 * Date: 10/27/2017
 * Time: 11:42 AM
 */

/**Given the email of the account to be deleted, Delete will search the database to either delete
 the account if created, or tell the user the account was not found.*/
class Delete{

   /**The email that the user wishes to delete from the table users*/
    public $email;

    function __construct($email){
        $this->email = $email;
    }

    /**deleteAccount will either delete the account that contains the given email or
     * will tell the user that it was not deleted.*/
    function deleteAccount($email){

        //Creating connection to the database
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
        $login_table_name = Config::LOGIN_TABLE_NAME;
        //WIll attempt to delete email from table if it exists
        $deleteQuery = "DELETE FROM $login_table_name WHERE Uemail= '$email'";

        if(mysqli_query($dbConnection,$deleteQuery)){
            echo "Successful deletion of the account ";
        }

        else{
            echo "Unable to delete the account";
        }
    }

    function deleteStudent($id){

        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');
        $student_table_name = Config::STUDENT_TABLE_NAME;

        //WIll attempt to delete student from STUDENT table
        $deleteQuery = "DELETE FROM $student_table_name WHERE Sid= '$id'";

        if(mysqli_query($dbConnection,$deleteQuery)){
            echo "Successful deletion of the student ";
        }

        else{
            echo "Unable to delete the student";
        }
    }

    function deleteRubric($id){

        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //WIll attempt to delete
        $deleteQuery = "DELETE FROM RUBRIC WHERE Rid= '$id'";

        if(mysqli_query($dbConnection,$deleteQuery)){
            echo "Successful deletion of the rubric ";
        }

        else{
            echo "Unable to delete the rubric";
        }
    }

}