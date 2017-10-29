<?php
/**
 * Account.php
 */

require_once 'config.php';


class Student
{
    //Used to create a new entry in the users table
    public $id, $fullName, $gradeLevel, $school;

    function  __construct($id, $fullName, $gradeLevel, $school) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->gradeLevel = $gradeLevel;
        $this->school = $school;

    }

    /**Takes the initialized variables to create a new account into the STUDENT tables
    in the database.*/
    function createStudentInDatabase() {

        //Connecting to the database to add the new user
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //Taking the values and inserting it into the user table
        $sqlQuery = "INSERT INTO STUDENT VALUES ('$this->id','$this->fullName','$this->gradeLevel','$this->school',NULL,NULL)";

        if(mysqli_query($dbConnection,$sqlQuery)){
            echo "Student added successfully";
        }

        else {
            echo "Student not added! " . mysqli_error($dbConnection);
        }
        mysqli_close($dbConnection);
    }

}