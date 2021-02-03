<?php

$host = 'localhost';
$felh = 'root';
$pass = '';
$dbName = 'esti_galeria';
$port='3306';        


$con = new mysqli($host, $felh,'',$dbName, $port);

if ($con -> errno){
    die('Nem sikerült csatlakozi az adatbázishoz!');
}
if (!$con ->set_charset('utf8')){
    echo 'A karakterkódolás beállísa sikertelen!';
}
