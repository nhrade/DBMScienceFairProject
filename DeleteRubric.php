<?php
session_start();
require_once "config.php";
require_once "Delete.php";

    $id = $_SESSION['DeleteID'];
    $delete = new Delete(NULL);
    $delete ->deleteRubric($id);
    header('Location: RubricMenu.php');
