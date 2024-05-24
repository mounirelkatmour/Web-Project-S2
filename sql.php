<?php 

function sectionInterns($id){
    $sql = "SELECT * FROM intern;";
    $result = sql($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            if (isset($id) && $row["id_intern"] == $id){            echo '<option value="'.$row["id_intern"].'" selected>'.$row["last_name_intern"]." ".$row["first_name_intern"].'</option>';
            }else
            echo '<option value="'.$row["id_intern"].'">'.$row["last_name_intern"]." ".$row["first_name_intern"].'</option>';
        }
    }
}



function sectionDep($id){
    
    $sql = "SELECT * FROM departement;";
    $result = sql($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            if (isset($id) && $row["id_depart"] == $id){
            echo '<option  value="'.$row["id_depart"].'" selected>'.$row["name_depart"].'</option>';
        }
        else echo '<option value="'.$row["id_depart"].'">'.$row["name_depart"].'</option>';
    }
        
    }
}   
function adminId2Name($id) {
    $sql = "SELECT name_admin from admin where id_admin=$id;";
    $result = sql($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["name_admin"];
    }
}
function depId2Name($id) {
    $sql = "SELECT name_depart from departement where id_depart=$id;";
    $result = sql($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["name_depart"];
    }
}
function InternId2ToFname($id) {
    $sql = "SELECT *from intern where id_intern=$id;";
    $result = sql($sql);
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        return $result["last_name_intern"]." ".$result["first_name_intern"];
        
    }
}
function sql($sql){
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "gestion_des_stagaires";
            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            $result = $conn->query($sql);
            return $result;}
?>