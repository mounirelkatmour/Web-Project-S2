<?php
session_start();
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

$sql = "SELECT * FROM intern";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="interns.css" />
    <title>Interns - Gestagiaire.ma</title>
</head>
<body>
    <div class="circle"></div>
    <div class="navbar">
    <div id="newDiv" class="hidden">☰</div>
        <a href="welcome.html" id="logobut" class="NavEl">Gestagiaire.ma</a>
        <a href="welcome.php" class="navEl" id="home">Home</a>
        <a href="depart.php" class="navEl" id="departments">Departements</a>
        <a href="interns.php" class="navEl" id="interns">Interns</a>
        <a href="internship.php" class="navEl" id="internships">Internships</a>
        <a href="addinterns.php" class="navEl" id="addintern">Add intern</a>
      <!-- Logout button -->
      <button class="Logout" onclick="location.href='logout.php'">Log Out</button>
    </div>
    <p id="listTxt">List of interns :</p>

    <table border="1">
        <tr>
            <th>Intern ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthdate</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_intern"] . "</td>";
                echo "<td>" . $row["first_name_intern"] . "</td>";
                echo "<td>" . $row["last_name_intern"] . "</td>";
                echo "<td>" . $row["birthdate_intern"] . "</td>";
                echo "<td>";
                echo "<a href='edit.php?intern_id=" . $row["id_intern"] . "'><button id='btn1' class='btn'>Edit</button></a>";
                echo "<button id='btn2' class='btn' onclick='confirmDelete(" . $row["id_intern"] . ")'>Remove</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No interns found</td></tr>";
        }
        ?>
    </table>

    <footer>
        <div class="copyright">
            <p>
                Copyright &copy;2024 Gestagiaire. Made by Mounir Elkatmour and Akram Elbahar.
            </p>
        </div>
    </footer>
    <script>
function confirmDelete(internId) {
    if (confirm("Are you sure you want to delete this intern?")) {
        window.location.href = "remove.php?id=" + internId;
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
        "#logo, #home, #departments, #interns, #internships,#addintern, .Logout"
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

</body>
</html>
