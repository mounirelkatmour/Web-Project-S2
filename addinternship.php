<?php

session_start();
include("sql.php");
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location: http://localhost/project/index.php");}
  
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if(!(isset($_POST['admin_id']) && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['id_intern']) && isset($_POST['id_dept']))){
        header('Location : http://localhost/project/addinternship.php');
    }
    else {
        $admin_id = $_POST['admin_id'];$start_date = new DateTime($_POST['start_date']);$end_date = new DateTime($_POST['end_date']);
        $id_intern = $_POST['id_intern'] ; $id_dept = $_POST['id_dept'];
        if($end_date > $start_date ){
        $sql = 'Insert into internship(id_admin,id_intern,id_depart,start_date,end_date) value ('.$admin_id.','.$id_intern.','.$id_dept.',"'.date_format($start_date,"Y-m-d").'","'.date_format($end_date,"Y-m-d").'");';
        $result = sql($sql);
        if (!$result)echo "ERROR OCCURED";
        else header("Location: http://localhost/project/internship.php");}
        else echo "error in start date should be before the end date ";
    }
    
}

include("addinternship.html");
?>