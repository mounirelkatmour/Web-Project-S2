<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("sql.php");
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
    header("Location: http://localhost/project/welcome.php");
    exit;
}
if (isset($_COOKIE["logged_in"]) && $_COOKIE["logged_in"] == 1) {
    $_SESSION["logged_in"] = true;
    $_SESSION["name_admin"] = $_COOKIE["name_admin"];
    $_SESSION["id_admin"] = $_COOKIE["id_admin"];
    header("Location: http://localhost/project/welcome.php");
    exit;
}
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["Login"];
    $password = $_POST["Password"];
    
    if(empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $sql = "SELECT * FROM admin WHERE name_admin='$username' AND pass_admin	
            ='$password'";
        $result = sql($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            if (!(isset($_POST['Remember']) && $_POST['Remember'] == 'on')) {
                $_SESSION["name_admin"] = $row["name_admin"];
                $_SESSION["id_admin"] = $row["id_admin"];
                $_SESSION["logged_in"] = True;
            
           
            } else {
                
                $_SESSION["id_admin"] = $row["id_admin"];
                $_SESSION["name_admin"] = $row["name_admin"];
                setcookie("name_admin", $row["name_admin"], time() + (7 * 24 * 3600));
                setcookie("id_admin", $row["id_admin"], time() + (7 * 24 * 3600));
                setcookie("logged_in", True, time() + (7 * 24 * 3600));
            }

            header('Location:http://localhost/project/welcome.php');
            exit();
        }else {
            $error = 'Invalid username or password!';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <title>Gestagiaire.ma - Login page</title>
</head>
<body>
        <?php if(isset($error) && !empty($error)) : ?>
            <div class="errormsg"><?php echo $error; ?></div>
        <?php endif; ?>
    <div class="circle"></div>
    <p id="LoginToGestagiaire">Login to Gestagiaire.ma</p>
    <div class="page">
        <div class="form">
            <form class="formLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="inpUser">
                    <img class="icon" src="username.png" alt="user icon" />
                    <label for="Login">Login</label>
                    <input id="inp1" class="input" name="Login" type="text" placeholder="Enter your username ..." /><br />
                </div>
                <div class="inpPass">
                    <img class="icon" src="lock.png" alt="lock icon" />
                    <label for="Password">Password</label>
                    <input id="inp2" name="Password" class="input" type="password" placeholder="Enter your password ..." />
                </div>
                <div class="newcheckbox">
                    <input class="checkme" id="rememberCheckbox" name="Remember" type="checkbox" />
                    <span id="RememberMe">Remember me</span>
                </div>
                <div class="submit">
                    <button id="checkbox" class="button">Submit</button>
                </div>
            </form>
        </div>
        <div class="company">
            <img src="image-company.png" alt="image-company" />
        </div>
    </div>
    <script src="script.js" defer></script>
    <script>
        document.getElementById("RememberMe").addEventListener("click", function () {
            var checkbox = document.getElementById("rememberCheckbox");
            checkbox.checked = !checkbox.checked;
        });
        
    </script>
</body>
</html>