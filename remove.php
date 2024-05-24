<?php

session_start();
include 'sql.php';
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}

if (!isset($_GET["id"])) {
    header("Location: interns.php");
    exit;
}
$id_intern = $_GET["id"];
if (!isset($_GET["id"])) {
    header("Location: ./");
    exit;
}
$sql = "DELETE FROM intern where id_intern=".$id_intern.";";
$result = sql($sql);
if (!$result) {
    echo "An error occurred while deleting  intern " . $id_intern." !";
} else  {
        header('Location: http://localhost/project/interns.php');
        exit;
  }

?>
