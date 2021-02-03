<?php

require_once('../config/init.php');

$sql = "SELECT DISTINCT kategoriak.id, kategoriak.kategoria  FROM allasok, kategoriak WHERE allasok.kategoria_id = kategoriak.id";

$res = $conn -> query($sql);
if (!$res){
    die();
}
$html = "<option value='0'>Kérem válasszon!</option>";

while ($row = $res -> fetch_array()){
    $html .= "<option value='{$row[0]}'>{$row[1]}</option>";
   
}
echo $html;
$conn -> close();