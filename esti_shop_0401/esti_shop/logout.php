<?php

session_start();
//unset($_SESSION['user']);

/*var_dump($_SESSION['user']);
echo "<br>";
var_dump($_SESSION['user'][0]);
echo "<br>";
var_dump($_SESSION['user'][1]);*/

session_destroy(); //munkamenet megsemmisítése
header("Location: index.php"); //átirányítás a kezdőlapra