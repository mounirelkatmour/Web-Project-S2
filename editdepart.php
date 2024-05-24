<?php
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}

if(isset($_GET['name_depart'])) {
    $id_depart = $_GET['name_depart'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion_des_stagaires";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM departement WHERE id_depart = $id_depart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name_depart = $row['name_depart'];
        $id_admin = $row['id_admin'];
    } else {
        echo "Depart not found";
        exit;
    }
    
    $conn->close();
}
if (isset($name_depart)) {
    
} else {
    $name_depart = 'name not found';    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="edit.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Departement - Gestagiaire.ma</title>
    <link rel="stylesheet" href="adddepart.css">
</head>
<body>
    <div class="content-container">
        <main>
            <div class="circle"></div>
            <div class="actions">
                <h2>Edit Departement</h2>
                <form id="editInternForm" method="post" action="updatedepart.php">
                    <input type="hidden" name="id_depart" value="<?php echo $id_depart; ?>">
                    <label for="name_depart">Name depart</label>
                    <input type="text" id="first_name_intern" name="name_depart" value="<?php echo $name_depart; ?>" required>
                    <br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </main>
    </div>
    <footer>
        <div class="copyright">
            <p>
                Copyright &copy;2024 Gestagiaire. Made by Mounir Elkatmour and Akram Elbahar.
            </p>
        </div>
    </footer>
</body>
</html>
