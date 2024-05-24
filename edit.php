<?php

if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}

if(isset($_GET['intern_id'])) {
    $intern_id = $_GET['intern_id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion_des_stagaires";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM intern WHERE id_intern = $intern_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['first_name_intern'];
        $last_name = $row['last_name_intern'];
        $birthdate = $row['birthdate_intern'];
    } else {
        header("Location: http://localhost/project/interns.php");
        exit;
    }
    
    $conn->close();
}
else {
    header("Location: http://localhost/project/interns.php");
}

if (isset($first_name)) {
    
} else {
    $first_name = 'name not found';    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="edit.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Intern - Gestagiaire.ma</title>
</head>
<body>
    <div class="content-container">
        <main>
            <div class="circle"></div>
            <div class="actions">
                <h2>Edit Intern</h2>
                <form id="editInternForm" method="post" action="updateintern.php">
                    <input type="hidden" name="id_intern" value="<?php echo $intern_id; ?>">
                    <label for="First_Name">First Name</label>
                    <input type="text" id="first_name_intern" name="first_name_intern" value="<?php echo $first_name; ?>" required>
                    <br>
                    <label for="Last_Name">Last Name</label>
                    <input type="text" id="last_name_intern" name="last_name_intern" value="<?php echo $last_name; ?>" required>
                    <br>
                    <label for="Birthdate">Birthdate</label>
                    <input type="date" id="birthdate_intern" name="birthdate_intern" value="<?php echo $birthdate; ?>" required>
                    <br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
