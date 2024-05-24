<?php

session_start();
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
  header("Location:http://localhost/project/index.php");}
if(!isset($_SESSION["id_admin"]) && !isset($_COOKIE["id_admin"])){
        header("Location: http://localhost/project/logout.php");}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_depart = $_POST["name_depart"];
    if(isset($_SESSION["id_admin"])){
        $id_admin = $_SESSION["id_admin"];
    }
    if(isset($_COOKIE["id_admin"])){
        $id_admin = $_COOKIE["id_admin"];
    }
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "gestion_des_stagaires";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO departement (name_depart,id_admin) VALUE ('$name_depart',$id_admin)";

    if ($conn->query($sql) === TRUE) {
        header("Location: depart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    include "adddepart.html";
    exit();
}
?>
