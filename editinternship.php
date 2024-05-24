<?php
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location:http://localhost/project/index.php");}
include "sql.php";
$sql = "select * from internship where id_internship=".$_GET["id"];

$result = sql($sql);
if($result->num_rows == 0){header("Location: http://localhost/project/internship.php");}
if($result->num_rows < 0){header("Location: http://localhost/project");}
$row = $result->fetch_assoc();
$start_date = $row["start_date"];
$end_date = $row["end_date"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="edit.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Intenship - Gestagiaire.ma</title>
    <style>
        html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

body {
  background-color: rgba(34, 17, 55, 1);
  position: relative;
  color: white;
}

.circle {
  background-color: rgba(236, 143, 58, 1);
  position: fixed;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%) translateY(75%);
  filter: blur(150px);
  margin-top: 0%;
  width: 120%;
  height: 30%;
  border-radius: 50%;
  z-index: -1;
  overflow: hidden;
}

button {
  color: white;
  background-color: rgb(124, 88, 155);
  height: 35px;
  width: 100px;
  font-size: 15px;
  border-radius: 10px;
  display: block;
  margin: 0 auto;
  cursor: pointer;
}
h2 {
  font-size: 50px;
  font-family: "Montserrat";
}
.content-container {
  border: 3px solid #c4c4c4;
  border-radius: 27px;
  padding: 0px;
  margin: 40px auto 0 auto;
  max-width: 450px; 
  height: 500px;
  text-align: center; 
}

.actions h2 {
  margin-top: 20px;
  margin-bottom: 20px; 
}
input,
select {
  width: 350px;
  height: 30px;
  border-radius: 10px;
  background-color: whitesmoke;
}
.actions form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.actions label,
.actions input,
.actions button,
.actions select {
  margin-bottom: 10px;
}

footer {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: black;
  height: 50px;
}

.copyright {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.copyright p {
  font-family: "Montserrat";
  color: white;
  font-size: 16px;
  margin: 0;
}

select {
  text-align: center;
}

    </style>
</head>
<body>
    <div class="content-container">
        <main>
            <div class="circle"></div>
            <div class="actions">
                <h2>Edit Internship</h2>
                <form id="editInternForm" method="post" action="updateinternship.php">
                    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">        
                    <label for="start_date">Start Date :</label>
                        <input type="date" required value="<?php echo $start_date;?>" name="start_date">
                    <br>
                    <label for="end_date">End Date:</label>
                        <input type="date" value="<?php echo $end_date;?>" required name="end_date">
                    
                    
                    <label for="id_intern">Choose a Intern:</label>
                    <select name="id_intern" required>
                        <?php sectionInterns($row["id_intern"]);?>
                    </select>
                    <br>
                    <label for="id_intern">Choose a Departement:</label>
                    <select name="id_dept" required>
                        <?php sectionDep($row["id_depart"]);?>
                    </select>
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
