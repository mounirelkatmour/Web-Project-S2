<?php
session_start();
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $birthdate = $_POST["Birthdate"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "gestion_des_stagaires";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO intern (first_name_intern, last_name_intern, birthdate_intern) VALUES ('$firstName', '$lastName', '$birthdate')";

    if ($conn->query($sql) === TRUE) {
        header("Location: interns.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    include("Location: addinterns.html");
    exit();
}
?>
