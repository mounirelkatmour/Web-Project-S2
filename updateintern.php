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
    
    $intern_id = $_POST["id_intern"];
    $first_name = $_POST["first_name_intern"];
    $last_name = $_POST["last_name_intern"];
    $birthdate = $_POST["birthdate_intern"];
    
    
    $sql = "UPDATE intern SET first_name_intern='$first_name', last_name_intern='$last_name', birthdate_intern='$birthdate' WHERE id_intern=$intern_id";
    
    if ($conn->query($sql) === TRUE) {
        
        header("Location: interns.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
