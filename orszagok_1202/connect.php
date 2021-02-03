<?php
$host = "localhost";
$dbUser = "root";
$dbpwd = "";
$dbName = "orszagok";
$port = "3306";

$connect = new mysqli($host, $dbUser, $dbpwd, $dbName, $port); //csatlakozás az adatbázis szerverhez
// var_dump($connect);

if ($connect -> errno){
    die("Hiba az adatbázishoz való csatlakozás során!");
 } //catlakozás során történt-e hiba?

if (!$connect -> set_charset("utf8")){
    echo "Nem sikerült a karakterkódolást beállítani!";
}
