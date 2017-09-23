<?php
/**
 * Logout.php
 */

session_start();
if($_SESSION['userloggedin']) {
    $_SESSION['userloggedin'] = false;
    header('Location: Login.php');
}