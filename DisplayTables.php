<?php
require 'config.php';
/**
 * Created by PhpStorm.
 * User: lgflores
 * Date: 10/27/2017
 * Time: 11:36 AM
 */

/**DisplayTables will handle the queries to display the specified tables when called.
 Different functions will handle the queries to display that specific table.*/
class DisplayTables
{

    /**Will create queries to display the users table that holds all of the
     accounts that have been created within the database.*/
    function displayUsersTable()
    {
        //Creating connection to the database
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //Need to display the accounts in users table so the user can select one to delete
        $displayAccountsQuery = "SELECT full_name,email,account_type FROM users";
        $results = $dbConnection -> query($displayAccountsQuery);

        //A table with 0 rows means that it is empty
        if($results->num_rows > 0) {
            $counter = 1;
            //Continues to move through the array rows that contains the entries of the users table
            while ($row = $results->fetch_assoc()) {
                echo '<br>'."-Account ".$counter ."- ";
                echo '<br>'."Name: " . $row["full_name"] . '<br>'." Email: " . $row["email"] .'<br>'. " Account Type: " . $row["account_type"] . "<br>";
                $counter++;
            }
        }
        else {
            echo "The table has no entries";
         }
    }

    function displayStudentTable(){

        //Creating connection to the database
        $dbConnection = mysqli_connect(Config::HOST, Config::UNAME,
            Config::PASSWORD, Config::DB_NAME) or die('Unable to connect to DB.');

        //Need to display the accounts in users table so the user can select one to delete
        $displayAccountsQuery = "SELECT Sid,Sfull_name,Sgrade_level,Sschool FROM STUDENT";
        $results = $dbConnection -> query($displayAccountsQuery);
        echo '<table class="table">';
        echo '<tr><td>Student</td></td><td>Name</td><td>ID</td><td>Grade</td><td>School</td></tr>';
        //A table with 0 rows means that it is empty
        if($results->num_rows > 0) {
            $counter = 1;

            //Continues to move through the array rows that contains the entries of the users table
            while ($row = $results->fetch_assoc()) {
                $full_name = $row['Sfull_name']; $id = $row['Sid'];
                $grade = $row['Sgrade_level']; $school = $row["Sschool"];

                echo <<<STUDENT_TABLE_ROW
                <tr>
                    <td>$counter</td>
                    <td>$full_name</td>
                    <td>$id</td>
                    <td>$grade</td>
                    <td>$school</td>
                </tr>
STUDENT_TABLE_ROW;
                $counter++;
            }
        }
        else {
            echo "The table has no entries";
        }
        echo '</table>';
    }
}