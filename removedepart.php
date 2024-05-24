<?php

session_start();
include 'sql.php';
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}

if (!isset($_GET["id"])) {
    header("Location: depart.php");
    exit;
}
$id_depart = $_GET["id"];
if (!isset($_GET["id"])) {
    header("Location: ./");
    exit;
}
$sql = "DELETE FROM departement where id_depart=".$id_depart.";";
$result = sql($sql);
if (!$result) {
    echo "An error occurred while deleting departement id " . $id_depart." !";
} else  {
        header('Location: http://localhost/project/depart.php');
        exit;
  }

?>
