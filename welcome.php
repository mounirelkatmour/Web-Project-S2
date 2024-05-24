<?php
session_start();
if(!isset($_SESSION["logged_in"]) && !isset($_COOKIE["logged_in"])){
    header("Location: http://localhost/project/index.php");}


if (isset($_SESSION["name_admin"])) {
    $name_admin = $_SESSION["name_admin"];
} elseif (isset($_COOKIE["name_admin"])) {
    $name_admin = $_COOKIE["name_admin"];
}
include("welcome.html");

