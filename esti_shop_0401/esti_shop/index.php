<?php

session_start(); //munkamenet követése miatt

require_once('config/connect.php'); //adatbázishoz csatlakozunk
require_once('config/functions.php');

echo file_get_contents("html/header.html");

menu();


$con->close();
echo file_get_contents("html/footer.html");






























