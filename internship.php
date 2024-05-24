<?php
session_start();
include("sql.php");

if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
  header("Location:http://localhost/project/index.php");}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_des_stagaires";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM internship";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="depart.css" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="internship.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Internships - Gestagiaire.ma</title>
</head>
<body>
    <div class="circle"></div>
    <div class="navbar">
    <div id="newDiv" class="hidden">☰</div>
        <a href="welcome.html" id="logobut" class="NavEl">Gestagiaire.ma</a>
        <a href="welcome.php" class="navEl" id="home">Home</a>
        <a href="depart.php" class="navEl" id="departments">Departements</a>
        <a href="interns.php" class="navEl" id="interns">Interns</a>
        <a href="internship.php" class="navEl" id="internship">Internship</a>
        <a href="addinternship.php" class="navEl" id="addinternship">Add Internship</a>
        <button class="Logout" onclick="location.href='logout.php'">
        Log Out
      </button>
    </div>
    <p id="listTxt">List of Internships :</p>
    <table border="1">
        <tr>
            <th>Internship ID</th>
            <th>Admin</th>
            <th>Departement</th>
            <th>Intern Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_internship"] . "</td>";
                echo "<td>" . adminId2Name($row["id_admin"])  . "</td>";
                echo "<td>" . depId2Name($row["id_depart"]) . "</td>";
                echo "<td>" . InternId2ToFname($row["id_intern"]). "</td>";
                echo "<td>" . $row["start_date"]. "</td>";
                echo "<td>" . $row["end_date"]. "</td>";
                echo "<td>";
                echo "<a href='editinternship.php?id=" . $row["id_internship"] . "'><button id='btn1' class='btn'>Edit</button></a>";
                echo "<button id='btn2' class='btn' onclick='confirmDelete(" . $row["id_internship"] . ")'>Remove</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No Internship found</td></tr>";
        }
        ?>
    </table>

</body>
<footer>
  <div class="copyright">
      <p>
          Copyright &copy;2024 Gestagiaire. Made by Mounir Elkatmour and Akram Elbahar.
      </p>
  </div>
</footer>
<script>
function confirmDelete(departId) {
    if (confirm("Are you sure you want to delete this Internship?")) {
        window.location.href = "removeinternship.php?id=" + departId;
    } else {
        alert("Deletion cancelled.");
    }
}
var x = 0;

    function checkMediaQuery() {
      if (window.innerWidth <= 811) {
        document.getElementById("newDiv").classList.remove("hidden");
        x = 1;
      } else {
        document.getElementById("newDiv").classList.add("hidden");
        x = 0;
      }

      var navElements = document.querySelectorAll(
        ".navbar a, #logobut, .Logout"
      );

      function changeClass() {
        navElements.forEach(function (element) {
          element.classList.toggle("hidenav");
        });
      }

      changeClass();
    }

    window.addEventListener("resize", checkMediaQuery);
    window.addEventListener("load", checkMediaQuery);

    document.getElementById("newDiv").addEventListener("click", function () {
      var logout = document.querySelector(".Logout");
      var navElements = document.querySelectorAll(
        "#logo, #home, #departments, #interns, #internships,#addinternship, .Logout"
      );

      if (x == 1) {
        logout.classList.remove("hidenav");
        navElements.forEach(function (element) {
          element.classList.remove("hidenav");
        });
        x = 0;
        newDivText.textContent = "Show less";
      } else {
        logout.classList.add("hidenav");
        navElements.forEach(function (element) {
          element.classList.add("hidenav");
        });
        x = 1;
        newDivText.textContent = "Show more";
      }
    });
</script>
</html>
