<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_des_stagaires";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name_depart = $_POST["name_depart"];
    $id_depart = $_POST["id_depart"];
    $id_admin = $_POST["id_admin"];
    
    
    $sql = "UPDATE departement SET name_depart='$name_depart' WHERE id_depart=$id_depart";
    
    if ($conn->query($sql) === TRUE) {
        
        header("Location: depart.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
