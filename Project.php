<?php
/**
 * Account.php
 */

require_once 'config.php';


class Project
{
    //Used to create a new entry
    public $id, $title, $description, $year, $category, $picture, $sid;

    function  __construct($id, $title, $description, $year, $category, $picture, $sid) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->year = $year;
        $this->category = $category;
        $this->picture = $picture;
        $this->sid = $sid;
    }


    function createProject() {

        //Connecting to the database to add the new user
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //Taking the values and inserting it into the user table
        $sqlQuery = "INSERT INTO PROJECT VALUES ('$this->id','$this->title','$this->description','$this->year','$this->category',
        '$this->picture','$this->sid')";

        if(mysqli_query($dbConnection,$sqlQuery)){
            echo "Project created successfully";
        }

        else {
            echo "Project not added! " . mysqli_error($dbConnection);
        }
        mysqli_close($dbConnection);
    }

}