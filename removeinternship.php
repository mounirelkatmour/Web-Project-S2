<?php

session_start();
include 'sql.php';
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}

if (!isset($_GET["id"])) {
    header("Location: internship.php");
    exit;
}
$id_depart = $_GET["id"];
if (!isset($_GET["id"])) {
    header("Location: ./");
    exit;
}
$sql = "Delete from internship WHERE id_internship=$id_depart";
$result = sql($sql);
if (!$result) {
    echo "An error occurred while deleting id_internship=" . $id_depart." !";
} else  {
        header('Location: http://localhost/project/internship.php');
        echo $sql;
        exit;
  }

?>
