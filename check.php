<? 
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
?>