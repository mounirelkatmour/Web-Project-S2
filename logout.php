<?php

session_start();
session_unset();
session_destroy();
setcookie("name_admin", "", time() - (7 * 24 * 3600));
setcookie("pass_admin", "", time() - (7 * 24 * 3600));
setcookie("logged_in" , "" , time());
setcookie("id_admin" , "" , time());
header("location:http://localhost/project/index.php");
exit;
?>
