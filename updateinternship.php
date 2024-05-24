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
    
    $id = $_POST["id"];
    $start_date = new DateTime( $_POST["start_date"]);
    $end_date = new DateTime($_POST["end_date"]);
    $id_intern = $_POST["id_intern"];
    $id_dept = $_POST["id_dept"];
    if($start_date > $end_date){
        echo "StartDate cannot be greater than EndDate ";exit();
    }
    $start_date = date_format($start_date,"Y-m-d");
    $end_date = date_format($end_date,"Y-m-d");
    $sql = "UPDATE internship SET start_date='$start_date', end_date='$end_date' , id_intern=$id_intern , id_depart=$id_dept  WHERE id_internship=$id";
    
    if ($conn->query($sql) === TRUE) {
        
        header("Location: internship.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
